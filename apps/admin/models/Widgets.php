<?php
namespace Ecommerce\Admin\Models;
class Widgets extends \Phalcon\Mvc\Model
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
    public $tipo_id;

    /**
     *
     * @var string
     */
    public $nome;

    /**
     *
     * @var string
     */
    public $namespace;

    /**
     *
     * @var double
     */
    public $valor_minimo;

    /**
     *
     * @var double
     */
    public $valor_minimo_parcela;

     /**
     *
     * @var integer
     */
    public $maximo_parcela;

    /**
     *
     * @var integer
     */
    public $parcela_sem_juros;

    /**
     *
     * @var double
     */
    public $juros_parcela;

    /**
     *
     * @var string
     */
    public $opcoes;

    /**
     *
     * @var integer
     */
    public $ativo;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('tipo_id', 'WidgetTipos', 'id', array('alias' => 'WidgetTipos'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'widgets';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Widgets[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Widgets
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
