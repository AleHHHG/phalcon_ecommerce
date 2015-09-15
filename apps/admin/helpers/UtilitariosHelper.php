<?php
namespace Ecommerce\Admin\Helpers;
use Phalcon\Tag;
use Ecommerce\Admin\Models\Produtos; 
class UtilitariosHelper extends Tag
{
    public function toMoney($param){
        return number_format($param,2,',','.');
    }

    public function dateFormat($param){
        return date('d/m/Y H:i:s',strtotime($param));
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
        $valores = ($action == 'update') ? implode(',', unserialize($uploads)) : "";
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
}