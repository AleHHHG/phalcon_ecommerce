<?php

namespace Ecommerce\Loja\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;

class ClienteForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($model = null, $options = array())
    {
        $session = $this->di->getShared('session');

        $nome = new Text("nome");
        $nome->setLabel('Nome');
        $nome->setAttribute('class','form-control ');
        $nome->setAttribute('value',$session->get('nome'));       
        $this->add($nome);

        $telefone = new Text("telefone");
        $telefone->setLabel('Telefone');
        $telefone->setAttribute('class','form-control ');
        $telefone->setAttribute('data-mask','(99)9999-9999');        
        $this->add($telefone);

        $celular = new Text("celular");
        $celular->setLabel('Celular');
        $celular->setAttribute('class','form-control ');
        $celular->setAttribute('data-mask','(99)9999-9999');        
        $this->add($celular);

     	$documento = new Text("documento");
        $documento->setLabel('CPF');
        $documento->setAttribute('class','form-control ');
        $documento->setAttribute('data-mask','999.999.999-99');        
        $this->add($documento);

    }
}