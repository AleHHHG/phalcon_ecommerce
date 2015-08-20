<?php

namespace Ecommerce\Admin\Forms;

use Ecommerce\Admin\Models\Categorias;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class CategoriaForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {

        if (isset($options['edit'])) {
            $this->add(new Hidden("id"));
        }

        $nome = new Text("nome");
        $nome->setLabel("Nome");
        $nome->setFilters(array('striptags', 'string'));
        $nome->setAttribute('class','form-control');
        $nome->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nome e obrigatorio'
            ))
        ));
        $this->add($nome);

        $categoria = new Select("parent", Categorias::returnArrayForSelect(), array(
            'using' => array('_id', 'nome'),
            'useEmpty' => true,
            'emptyText'  => 'Nenhuma',
            'emptyValue' => ''
        ));
        $categoria->setLabel("Selecione a categoria pai*");
        $categoria->setAttribute('class','form-control');
        $this->add($categoria);
    }
}