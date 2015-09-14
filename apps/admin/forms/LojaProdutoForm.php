<?php

namespace Ecommerce\Admin\Forms;

use Ecommerce\Admin\Models\Categorias;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class LojaProdutoForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {
        
        $produto_detalhes = new Select("produto_detalhes", array(
            '0' => 'Não',
            '1' => 'Sim'
        ));
        $produto_detalhes->setLabel('produto detalhes ?');
        $this->add($produto_detalhes);

        $produto_cubagem_detalhe = new Select("produto_cubagem_detalhe", array(
            '0' => 'Não',
            '1' => 'Sim'
        ));
        $produto_cubagem_detalhe->setLabel('Cubagem no detalhe ?');
        $this->add($produto_cubagem_detalhe);

    }
}