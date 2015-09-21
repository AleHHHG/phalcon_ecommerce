<?php

namespace Ecommerce\Admin\Forms;

use Ecommerce\Admin\Models\Categorias;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\File;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class ProdutoForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {
        $nome = new Text("nome");
        $nome->setLabel("Nome");
        $nome->setAttribute('class','form-control');
        $this->add($nome);
        $categoria = new Select("categoria", Categorias::returnArrayForSelect(), array(
            'using' => array('_id', 'nome')
        ));
        $categoria->setLabel("Categoria");
        $categoria->setAttribute('class','form-control');
        $this->add($categoria);

        #Opçõs setadas dinamicamente
        $detalhes = unserialize($this->ecommerce_options->produto_options);
        foreach ($detalhes as $key => $value) {
            $chave = $key;
            $chave = new Select("detalhes[{$value['label']}][]", $value['referencia']::find(array('order' => 'nome ASC')), array(
                'using' => array('nome', 'nome'),
                'useEmpty'   => true,
                'emptyText'  => 'Nenhum ...',
                'emptyValue' => null,
            ));
            $chave->setLabel($value['label']);
            $chave->setAttribute('class','form-control '.$value['label']);
            if(isset($obj) && !is_null($obj)){
                $chave->setDefault($obj->$value['label']);
            }
            $this->add($chave);
        }

        #Caso detalhes do produto esteja habilitado
        if($this->ecommerce_options->produto_detalhes == '0'){
            $valor = new Text("valor");
            $valor->setAttribute('class','form-control money');
            $this->add($valor);

            $desconto = new Text("desconto");
            $desconto->setAttribute('class','form-control money');
            $this->add($desconto);

            $estoque = new Numeric("estoque");
            $estoque->setAttribute('class','form-control');
            $estoque->setAttribute('rows','5');
            $this->add($estoque);
        }

        $descricao = new TextArea("descricao");
        $descricao->setLabel("Descrição");
        $descricao->setAttribute('class','form-control summernote');
        $descricao->setAttribute('rows','10');
        $this->add($descricao);
        
        $destaque = new Select('destaque',array(
            0 => 'Não',
            1 => 'Sim',
        ));
        $destaque->setLabel('Destaque');
        $destaque->setAttribute('class','form-control');
        $this->add($destaque);

        $ativo = new Select('ativo',array(
            0 => 'Não',
            1 => 'Sim',
        ));
        $ativo->setLabel('Ativo');
        $ativo->setAttribute('class','form-control');
        $this->add($ativo);

        if($this->ecommerce_options->produto_cubagem_detalhe == '0'){
            #Input Estoque
            $peso = new Numeric("peso");
            $peso->setLabel("peso");
            $peso->setAttribute('class','form-control');
            $this->add($peso); 

            #Input Estoque
            $altura = new Numeric("altura");
            $altura->setLabel("altura");
            $altura->setAttribute('class','form-control');
            $this->add($altura); 

              #Input Estoque
            $largura = new Numeric("largura");
            $largura->setLabel("largura");
            $largura->setAttribute('class','form-control');
            $this->add($largura); 

              #Input Estoque
            $comprimento = new Numeric("comprimento");
            $comprimento->setLabel("comprimento");
            $comprimento->setAttribute('class','form-control');
            $this->add($comprimento); 
        }

        $meta_title = new Text("meta_title");
        $meta_title->setLabel("Meta Title");
        $meta_title->setAttribute('class','form-control');
        $this->add($meta_title);

        $meta_description = new TextArea("meta_description");
        $meta_description->setLabel("Meta Description");
        $meta_description->setAttribute('class','form-control');
        $meta_description->setAttribute('rows','5');
        $this->add($meta_description);

        $meta_keywords = new TextArea("meta_keywords");
        $meta_keywords->setLabel("Meta Keywords");
        $meta_keywords->setAttribute('class','form-control');
        $meta_keywords->setAttribute('rows','5');
        $this->add($meta_keywords);
    }
}