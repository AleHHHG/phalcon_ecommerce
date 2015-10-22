<?php 

namespace Ecommerce\Admin\Models;
class Tamanhos extends \Phalcon\Mvc\Model
{

    public $id;
    public $nome;

    public function rules(){
        return array(
            'id' => array(
                'primary' =>true,
                'type' => 'text'
            ),
            'nome' => array(
                'type'=> 'text'
            ),
        );
    }


    public function getSource(){
        return 'tamanhos';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Categorias[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Categorias
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}
