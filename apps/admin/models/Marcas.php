<?php 

namespace Ecommerce\Admin\Models;
class Marcas extends \Phalcon\Mvc\Model
{

    public $id;
    public $nome;
    public $logo;

    public function rules(){
        return array(
            'id' => array(
                'primary' => true,
                'type' => 'text'
            ),
            'nome' => array(
                'type'=> 'text',
            ),
            'logo' => array(
                'type' => 'file' 
            ),
        );
    }

    public function getSource(){
        return 'marcas';
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
