<?php

namespace Ecommerce\Admin\Forms;

use Ecommerce\Admin\Models\Categorias;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class LojaGeralForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {
           
        $titulo = new Text("titulo");
        $this->add($titulo);

        $email = new Text("email");
        $this->add($email);

        $email = new Text("email");
        $this->add($email);

        $produtos_por_pagina = new Numeric("produtos_por_pagina");
        $produtos_por_pagina->setLabel('Produtos por pagina');
        $this->add($produtos_por_pagina);

        $produtos_destaque_quantidade = new Numeric("produtos_destaque_quantidade");
        $produtos_destaque_quantidade->setLabel('Quantidade de destaques exibidos por vez:');
        $this->add($produtos_destaque_quantidade);

    }
}