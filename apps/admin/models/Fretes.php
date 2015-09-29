<?php
namespace Ecommerce\Admin\Models;
class Fretes extends \Phalcon\Mvc\Model
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
    public $tipo;

    /**
     *
     * @var string
     */
    public $nome;

     /**
     *
     * @var double
     */
    public $valor_minimo;

    /**
     *
     * @var string
     */
    public $cep_inicial;

    /**
     *
     * @var string
     */
    public $cep_final;

    /**
     *
     * @var string
     */
    public $produtos;

    /**
     *
     * @var integer
     */
    public $ativo;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'fretes';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Fretes[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Fretes
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
