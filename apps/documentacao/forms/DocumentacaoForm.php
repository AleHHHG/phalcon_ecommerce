<?php

namespace Ecommerce\Documentacao\Forms;

use Ecommerce\Documentacao\Models\Documentacao;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\TextArea;

class DocumentacaoForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {
        $nome = new Text("nome");
        $nome->setLabel("nome");
        $nome->setAttribute('class','form-control');
        $this->add($nome);

        // $parent = new Select("parent", Categorias::returnArrayForSelect(), array(
        //     'using' => array('id', 'nome'),
        //     'useEmpty' => true,
        //     'emptyText'  => 'Nenhuma',
        //     'emptyValue' => '0'
        // ));
        // $parent->setLabel("Selecione o pai");
        // $parent->setAttribute('class','form-control');
        // $this->add($parent);
        
        $descricao = new TextArea("conteudo");
        $descricao->setLabel("Conteudo");
        $descricao->setAttribute('class','form-control summernote');
        $descricao->setAttribute('rows','15');
        $this->add($descricao);
    }
}