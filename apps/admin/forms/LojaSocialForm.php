<?php

namespace Ecommerce\Admin\Forms;

use Ecommerce\Admin\Models\Categorias;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class LojaSocialForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {
           
        $f = new Text("facebook");
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new Text("twitter");
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new Text("google_plus");
        $f->setAttribute('class','form-control');
        $f->setLabel("G+");
        $this->add($f);

    }
}