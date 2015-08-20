<?php

namespace Ecommerce\Admin\Models;
class Imagens extends \Phalcon\Mvc\Model
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
    public $url;

    /**
     *
     * @var string
     */
    public $thumbnail;

    /**
     *
     * @var integer
     */
    public $principal;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'imagens';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Imagens[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Imagens
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
