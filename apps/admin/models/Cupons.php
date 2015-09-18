<?php
namespace Ecommerce\Admin\Models;
class Cupons extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $nome;

    /**
     *
     * @var string
     */
    public $codigo;

    /**
     *
     * @var integer
     */
    public $quantidade;

    /**
     *
     * @var integer
     */
    public $quantidade_uso;

    /**
     *
     * @var double
     */
    public $valor;

    /**
     *
     * @var double
     */
    public $valor_minimo;

    /**
     *
     * @var string
     */
    public $data_expiracao;

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
        return 'cupons';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cupons[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cupons
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
