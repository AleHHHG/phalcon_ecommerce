<?php
namespace Ecommerce\Admin\Models;
class Enderecos extends \Phalcon\Mvc\Model
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
    public $estado_id;

    /**
     *
     * @var integer
     */
    public $cidade_id;

    /**
     *
     * @var integer
     */
    public $id_relacao;

    /**
     *
     * @var string
     */
    public $relacao;

    /**
     *
     * @var string
     */
    public $cep;

    /**
     *
     * @var string
     */
    public $logradouro;

    /**
     *
     * @var string
     */
    public $bairro;

    /**
     *
     * @var integer
     */
    public $numero;

    /**
     *
     * @var string
     */
    public $complemento;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('cidade_id', 'Ecommerce\Admin\Models\Cidades', 'id', array('alias' => 'Cidade'));
        $this->belongsTo('estado_id', 'Ecommerce\Admin\Models\Estados', 'id', array('alias' => 'Estado'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'enderecos';
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
