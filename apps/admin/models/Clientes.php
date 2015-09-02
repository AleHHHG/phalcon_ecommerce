<?php
namespace Ecommerce\Admin\Models;
class Clientes extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

      /**
     *
     * @var integer
     */
    public $usuario_id;

    /**
     *
     * @var string
     */
    public $telefone;

     /**
     *
     * @var string
     */
    public $celular;

      /**
     *
     * @var string
     */
    public $documento;

    /**
     *
     * @var integer
     */
    public $pessoa_juridica;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('usuario_id', 'Ecommerce\Admin\Models\Usuarios', 'id', array('alias' => 'Usuario'));
    }
    
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'clientes';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Enderecos[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Enderecos
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
