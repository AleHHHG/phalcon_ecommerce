<?php
namespace Ecommerce\Admin\Helpers;
use Phalcon\Tag;
use Ecommerce\Admin\Models\Produtos; 
class UtilitariosHelper extends Tag
{
    public function toMoney($param){
        return number_format($param,2,',','.');
    }

    public function dateFormat($param,$format = null){
        if(is_null($format)){
            $format = "d/m/Y H:i:s";
        }
        return date($format,strtotime($param));
    }

    public function getProduto($param){
    	return Produtos::findById($param);
    }

    public function getProdutodetalhes($detalhe){
        $eo = $this->getDI()->getShared('ecommerce_options');	
        $detalhes = unserialize($eo->produto_detalhe_options);
        $itens = '';
        foreach ($detalhes as $key => $value) {
            if(isset($detalhe[$value['label']])){
                $itens .= $value['label'].' : '.$detalhe[$value['label']];
            }
        }
        return $itens;
    }

    public function getUploadCenter($name,$action,$uploads = null, $imagens = null){
        $url = $this->getDI()->getShared('url');
        $html = '<label>'.ucwords($name).'</label><br/>';
        if($action == 'update'){
            if(is_string($uploads)){
                $valores = implode(',', unserialize($uploads));
            }else{
                $valores = implode(',',$uploads);
            }
        }else{
            $valores = '';
        }
        $html .= '<input type="hidden" class="upload-target-values" value="'.$valores.'" name="'.$name.'">'; 
        $html .= '<a href="#target-upload" data-url="'.$url->getBaseUri().'admin/upload" data-toggle="modal" class="btn btn-info call-upload">Adicionar Imagens</a>';
        $html .= '<hr/>';
        $html .= '<div id="selected-content">';
        if($action == 'update'){
            foreach ($imagens as $key => $value) {
                $html .= '<div class="col-md-3 thumbnail dragContent" draggable="true" style="padding:20px;">
                            <input type="checkbox" name="imagens_selecionadas" style="display:none" class="pull-right imagem-select" value="'.$value->id.'">
                            <img src="'.$url->getBaseUri().'public/timthumb?src='.$url->getBaseUri().'public/'.$value->url.'&q=90&w=215&h=161&zc=2" class="img-reponsive" onmousedown="return false" />
                         </div>';
            }
        }
        $html .= '</div>';
        return $html;
    }

    public function tofloat($num) {
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

    public function limpaString($string){
        return preg_replace ('/\D/' ,'' ,$string);
    }
}