<?php

namespace Ecommerce\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\TextArea;


class LojaInformacoesForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array()){
           
        $f = new TextArea("politica_de_privacidade");
        $f->setLabel('<strong>Politica de privacidade</strong>');
        $f->setAttribute('class','form-control');
        $f->setAttribute('rows','10');
        $this->add($f);

        $f = new TextArea("politica_de_entrega");
        $f->setLabel('<strong>Politica de entrega</strong>');
        $f->setAttribute('class','form-control');
        $f->setAttribute('rows','10');
        $this->add($f);

        $f = new TextArea("termos_de_uso");
        $f->setLabel('<strong>termos de usos</strong>');
        $f->setAttribute('class','form-control');
        $f->setAttribute('rows','10');
        $this->add($f);

        $f = new TextArea("trocas_e_devolucoes");
        $f->setLabel('<strong>troca é devoluções</strong>');
        $f->setAttribute('class','form-control');
        $f->setAttribute('rows','10');
        $this->add($f);
    }
}