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
                $valores = implode($uploads);
            }
        }else{
            $valores = '';
        }
        $html .= '<input type="hidden" class="upload-target-values" value="'.$valores.'" name="'.$name.'">'; 
        $html .= '<a href="#target-upload" id="call-upload" data-url="'.$url->getBaseUri().'admin/upload" data-toggle="modal" class="btn btn-info">Adicionar Imagem</a>';
        $html .= '<hr/>';
        $html .= '<div id="selected-content">';
        if($action == 'update'){
            foreach ($imagens as $key => $value) {
                $html .= '<div class="col-md-3 thumbnail" style="padding:20px">
                            <img src="'.$url->getBaseUri().$value->url.'" class="img-reponsive" />
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