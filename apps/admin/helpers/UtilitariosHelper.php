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
}