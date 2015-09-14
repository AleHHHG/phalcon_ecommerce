<?php 

namespace Ecommerce\Admin\Models;
class Produtos extends \Phalcon\Mvc\Collection
{
    public $nome;
    public $categoria;
    public $destaque = 0;
    public $ativo = 1;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $descricao;

    public function beforeSave(){
        $opcoes = $this->getDI()->getShared('ecommerce_options');
        if($opcoes->produto_detalhes == '0'){
            $this->valor = $_POST['valor'];
            $this->estoque = $_POST['estoque'];
        }else{
            $arr = array();
            if(isset($_POST['detalhes'])){
                for ($i=0; $i < count($_POST['detalhes']['valor']); $i++){
                    foreach ($_POST['detalhes'] as $key => $value) {
                        if($key == 'valor'){
                            $arr[$i][$key] = Produtos::toFloat($value[$i]);
                        }else{
                           $arr[$i][$key] = $value[$i]; 
                        }
                    }
                    if(!isset($_POST['detalhes']['detalhe_id'][$i])|| $_POST['detalhes']['detalhe_id'][$i] == '0'){
                        $arr[$i]['detalhe_id'] = (string) new \MongoId();
                    }
                }
                $this->detalhes = $arr;
            }
        }
    }

    public function beforeCreate()
    {
        // Set the creation date
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function beforeUpdate()
    {
        // Set the modification date
        $this->modified_in = date('Y-m-d H:i:s');
    }

    public function getSource()
    {
        return "produtos";
    }

    public static function returnArrayForSelect()
    {
        $array = array();
        foreach (self::find() as $v) {
            $array[(string) $v->_id] = $v->nome;
        }
        return $array;
    }

    public static function tofloat($num) {
        $dotPos = strrpos($num, '.');
        $commaPos = strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos : 
            ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
       
        if (!$sep) {
            return floatval(preg_replace("/[^0-9]/", "", $num));
        } 

        return floatval(
            preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
        );
    }


}
?>