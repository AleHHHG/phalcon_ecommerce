<?php

namespace Ecommerce\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
class ProdutosRelacionadosForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($model = null, $options = array())
    {
        $eo = $this->getDI()->getShared('ecommerce_options');
        $utilitarios = $this->getDI()->getShared('Utilitarios');
        $opcao = new Text('relacionado');
        $opcao->setLabel('Produtos Relacionados');
        $opcao->setAttribute('class','form-control');
        $opcao->setAttribute('id','produtos_relacionados');
        $opcao->setAttribute('data-url',$eo->url_base.'admin/produtos');
        $arr = array();
        if(!is_null($model) && !empty($model->relacionados)){
            foreach ($model->relacionados as $key => $value) {
                $produto = $utilitarios->getProduto($value);
                $arr[$key]['id'] = (string)$produto->_id;
                $arr[$key]['name'] = $produto->nome;
            }
        }
        $opcao->setAttribute('data-pre',json_encode($arr));
        $this->add($opcao);
    }
}