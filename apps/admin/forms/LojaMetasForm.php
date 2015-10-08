<?php

namespace Ecommerce\Admin\Forms;

use Ecommerce\Admin\Models\Categorias;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\TextArea;


class LojaMetasForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array()){
           
        $f = new TextArea("meta_description");
        $f->setLabel('Meta Description');
        $f->setAttribute('class','form-control');
        $f->setAttribute('rows','10');
        $this->add($f);

        $f = new TextArea("meta_keyword");
        $f->setLabel('Meta Keywords');
        $f->setAttribute('class','form-control');
        $f->setAttribute('rows','10');
        $this->add($f);

    }
}