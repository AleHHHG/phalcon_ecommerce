<?php
namespace Ecommerce\Admin\Models;
class Pedidos extends \Phalcon\Mvc\Model
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
    public $status_id;

    /**
     *
     * @var integer
     */
    public $usuario_id;

    /**
     *
     * @var integer
     */
    public $forma_pagamento;

    /**
     *
     * @var integer
     */
    public $frete_codigo;

    /**
     *
     * @var double
     */
    public $frete;

    /**
     *
     * @var double
     */
    public $valor;

    /**
     *
     * @var double
     */
    public $total;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('frete_codigo', 'Ecommerce\Admin\Models\FreteTipos', 'codigo', array('alias' => 'FreteTipos'));
        $this->belongsTo('usuario_id', 'Ecommerce\Admin\Models\Usuarios', 'id', array('alias' => 'Usuario'));
        $this->belongsTo('status_id', 'Ecommerce\Admin\Models\PedidoStatus', 'id', array('alias' => 'PedidoStatus'));
        $this->belongsTo('forma_pagamento', 'Ecommerce\Admin\Models\Widgets', 'id', array('alias' => 'Widgets'));
        $this->hasMany('id', 'Ecommerce\Admin\Models\PedidoItens', 'id', array('alias' => 'Itens'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'pedidos';
    }

    public function createData($cart,$post){
        $session = $this->getDI()->getShared('session');
        $this->usuario_id = 2;
        $this->frete_codigo = $post['tipo_frete'];
        $this->valor = $cart->total();
        $this->frete = $session->get('frete')['valor'];
        $this->total = $cart->total() + $session->get('frete')['valor'];
        $this->forma_pagamento = $post['forma_pagamento'];
        if($this->save()){
            return $this->id;
        }
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Pedidos[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Pedidos
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
