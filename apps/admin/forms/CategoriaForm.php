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
    public function initialize($model = null, $options = array())
    {
        $nome = new Text("nome");
        $nome->setLabel("Nome");
        $nome->setFilters(array('striptags', 'string'));
        $nome->setAttribute('class','form-control');
        $this->add($nome);
        if(is_null($model)){
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
}