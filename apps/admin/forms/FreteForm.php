<?php

namespace Ecommerce\Admin\Forms;

use Ecommerce\Admin\Models\Posicao;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Categorias;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Numeric;

class FreteForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($model = null, $options = array())
    {
        $eo = $this->getDI()->getShared('ecommerce_options');
        $utilitarios = $this->getDI()->getShared('Utilitarios');
        
        $nome = new Text("nome");
        $nome->setAttribute('class','form-control');
        $this->add($nome);

        $valor_minimo = new Text('valor_minimo');
        $valor_minimo->setLabel('Valor mínimo do pedido');
        $valor_minimo->setAttribute('class','form-control money');
        $this->add($valor_minimo);

        $ativo = new Select(
            "ativo",
            array(
                '1' => 'Sim',
                '2' => 'Não',
            )
        );
        $ativo->setAttribute('class','form-control');
        $this->add($ativo);

        $opcao = new Select(
            "tipo",
            array(
                '1' => 'Região',
                '2' => 'Cidade',
                '3' => 'Produtos',
            ),
            array(
                'useEmpty'   => true,
                'emptyText'  => 'Selecione',
            )
        );
        $opcao->setAttribute('class','form-control tipo-frete');
        $opcao->setLabel('Tipo');
        $this->add($opcao);

        $opcao = new Text('cep_inicial');
        $opcao->setAttribute('class','form-control cep-faixa');
        $opcao->setLabel('CEP Inicial');
        $this->add($opcao);

        $opcao = new Text('cep_final');
        $opcao->setAttribute('class','form-control cep-faixa');
        $opcao->setLabel('CEP Final');
        $this->add($opcao);

        $opcao = new Text('produtos');
        $opcao->setLabel('Produtos');
        $opcao->setAttribute('class','form-control frete-produtos');
        $opcao->setAttribute('id','produtos_relacionados');
        $opcao->setAttribute('data-url',$eo->url_base.'admin/produtos');
        $arr = array();
        if(!is_null($model) && $model->tipo == 3){
            $produtos = unserialize($model->produtos);
            foreach ($produtos as $key => $value) {
                $produto = $utilitarios->getProduto($value);
                $arr[$key]['id'] = (string)$produto->_id;
                $arr[$key]['name'] = $produto->nome;
            }
        }
        $opcao->setAttribute('data-pre',json_encode($arr));
        $this->add($opcao);
    }
}