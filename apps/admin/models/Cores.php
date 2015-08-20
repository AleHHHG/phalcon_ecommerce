<?php 

namespace Ecommerce\Admin\Models;
class Cores extends \Phalcon\Mvc\Model
{

    public $id;
    public $nome;
    public $hexa;


    public function getSource(){
        return 'cores';
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
