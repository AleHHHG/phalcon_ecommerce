<?php

namespace Ecommerce\Admin\Models;
class Banners extends \Phalcon\Mvc\Model
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
    public $posicao_id;

    /**
     *
     * @var string
     */
    public $produto_id;

    /**
     *
     * @var string
     */
    public $categoria_id;

    /**
     *
     * @var string
     */
    public $nome;

    /**
     *
     * @var string
     */
    public $descricao;

    /**
     *
     * @var string
     */
    public $link;

    /**
     *
     * @var integer
     */
    public $ordem;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('posicao_id', 'Ecommerce\Admin\Models\Posicao', 'id', array('alias' => 'Posicao'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'banners';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Banners[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Banners
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
