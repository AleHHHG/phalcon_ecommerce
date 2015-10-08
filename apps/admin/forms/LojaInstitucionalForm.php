<?php

namespace Ecommerce\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\TextArea;


class LojaInstitucionalForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array()){
           
        $f = new TextArea("institucional");
        $f->setLabel('&nbsp');
        $f->setAttribute('class','form-control summernote');
        $this->add($f);
    }
}