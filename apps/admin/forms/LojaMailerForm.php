<?php

namespace Ecommerce\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\TextArea;


class LojaMailerForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array()){
           
        $f = new TextArea("email_pedido_criado");
        $f->setLabel('Notificador pedido criado');
        $f->setAttribute('class','form-control summernote');
        $this->add($f);

        $f = new TextArea("email_pedido_aprovado");
        $f->setLabel('Notificador pedido aprovado');
        $f->setAttribute('class','form-control summernote');
        $this->add($f);

      	$f = new TextArea("email_pedido_cancelado");
        $f->setLabel('Notificador pedido cancelado');
        $f->setAttribute('class','form-control summernote');
        $this->add($f);

        $f = new TextArea("email_pedido_concluido");
        $f->setLabel('Notificador pedido concluido');
        $f->setAttribute('class','form-control summernote');
        $this->add($f);

        $f = new TextArea("email_pedido_transporte");
        $f->setLabel('Notificador pedido em transporte');
        $f->setAttribute('class','form-control summernote');
        $this->add($f);
    }
}