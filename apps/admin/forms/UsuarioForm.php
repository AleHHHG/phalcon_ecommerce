<?php

namespace Ecommerce\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
class UsuarioForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {      
        $titulo = new Text("nome");
        $titulo->setAttribute('class','form-control ');
        $this->add($titulo);

        $email = new Text("email");
        $email->setAttribute('class','form-control ');
        $this->add($email);

    }
}