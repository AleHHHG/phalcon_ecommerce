<?php 

namespace Ecommerce\Admin\Models;
use Ecommerce\Admin\Models\Posicao;
class Categorias extends \Phalcon\Mvc\Collection
{
    public $nome;
    public $parent;
    public $subcategorias = array();
    public $produtos = array();

    public function beforeCreate()
    {
        // Set the creation date
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function beforeSave()
    {
        if($this->parent != ''){
            $pai = Categorias::findById($this->parent);
            if(!empty($pai)){
                array_push($pai->subcategorias, $this->getId());
                $pai->subcategorias = array_unique($pai->subcategorias);
                $pai->save();
            }
        }
    }

    public function beforeUpdate()
    {
        // Set the modification date
        $this->modified_in = date('Y-m-d H:i:s');
    }

    public static function getDados(){
        $categorias = self::find();
        return array_map(array('self','getParent'), $categorias);
    }

    public static function getParent($obj){
        $pai = self::findById($obj->parent);
        if($pai){
            $obj->pai = array();
            $obj->pai[] = $pai;
            $obj = self::getRecursividade($obj,$pai);
            $obj->pai = array_reverse($obj->pai);
        }
        return $obj;
    }

    public static function getRecursividade($param,$obj){
        $pai = self::findById($obj->parent);
        if($pai){
           $param->pai[] = $pai;
           self::getRecursividade($param,$pai); 
        }
        return $param;
    }


    public static function getDadosMenu($principal = false){
        $array = array();
        $array['conditions']['parent'] = null;
        if($principal){
            $array['conditions']['menu_principal'] = '1';
        }
        $categorias = self::find($array);
        $dados = array_map(array('self','getChildrens'), $categorias);
        return array_reverse($dados);
    }

    public static function getChildrens($obj){       
        $arr = array();
        if(!empty($obj->subcategorias)){           
            for ($i=0; $i < count($obj->subcategorias) ; $i++) {                 
                $filho = self::findById($obj->subcategorias[$i]);
                if($filho){
                    $arr[$i]['nome'] = $filho->nome;
                    $arr[$i]['id'] = $filho->_id;
                    $arr[$i]['children'] = self::getChildrensRecursivo($filho);
                }
            }
        }
        $obj->subcategorias = $arr;
        return $obj;
    }

    public static function getChildrensIds($obj,$item = false){
        $arr = array();
        if($item){
            $categorias = $obj;
        }else{    
            $arr['current'] = $obj->_id;        
            $categorias = self::getChildrens($obj)->subcategorias;
        }
        foreach ($categorias as $key => $value) {
            $subs = array();
            $arr[] = $value['id'];
            if(!empty($value['children'])){
                $subs = self::getChildrensIds($value['children'],true);
            }
            $arr = array_merge($arr,$subs);
        }
        return $arr;
    }

    public static function getChildrensRecursivo($obj){
        $arr = array();
        if(!empty($obj->subcategorias)){
            for ($i=0; $i < count($obj->subcategorias) ; $i++) { 
                $filho = self::findById($obj->subcategorias[$i]);
                if($filho){
                    $arr[$i]['nome'] = $filho->nome;
                    $arr[$i]['id'] = $filho->_id;
                    $arr[$i]['children'] = self::getChildrensRecursivo($filho->subcategorias);
                }
            }
        }
        return $arr;
    }

    public static function returnArrayForSelect()
    {
        $array = array();
        foreach (self::getDados() as $v) {
            $nome = '';
            if (isset($v->pai)) {
                foreach ($v->pai as $pai) { 
                    $nome .= $pai->nome.' / ';
                } 
            }
            $nome .= $v->nome;
            $array[(string) $v->_id] = $nome;
        }
        asort($array);
        return $array;
    }
}
?>