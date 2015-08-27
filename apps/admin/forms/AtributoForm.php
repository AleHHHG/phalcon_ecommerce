<?php

namespace Ecommerce\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\File;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class AtributoForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {
        if (isset($options['edit'])) {
            $item = new Hidden("id");
            $item->setAttribute('class','dynamicId');
            $this->add($item);
        }

        $attr = new $options['referencia'];
        foreach ($attr->rules() as $key => $value) {
            if($value['type'] == 'select'){
                $item = new Select($key, $value['referencia']::find(), array(
                        'using' => array('_id', 'nome'),
                ));
            }else if($value['type'] == 'hidden'){
                $item = new Hidden($key);
            }else if($value['type'] == 'textarea'){
                $item = new TextArea($key);
            }else if($value['type'] == 'number'){
                $item = new Numeric($key);
            }else if($value['type'] == 'file'){
                $item = new File($key);
            }else{
                $item = new Text($key);
            }
            $item->setAttribute('class','form-control');
            if(!$value['type'] == 'file'){
                $item->setAttribute('required','true');
            }
            if(!isset($value['primary']) && !isset($value['hide'])){
                $this->add($item);
            }
        }
    }
}