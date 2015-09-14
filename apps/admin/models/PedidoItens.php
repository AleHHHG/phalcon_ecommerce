<?php
namespace Ecommerce\Admin\Models;
class PedidoItens extends \Phalcon\Mvc\Model
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
    public $produto_id;

    /**
     *
     * @var integer
     */
    public $pedido_id;

    /**
     *
     * @var integer
     */
    public $quantidade;

    /**
     *
     * @var double
     */
    public $valor;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'pedido_itens';
    }

    public function initialize()
    {
        $this->belongsTo('pedido_id', 'Ecommerce\Admin\Models\Pedidos', 'id', array('alias' => 'Pedido'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PedidoItens[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    public function createData($itens,$pedido_id){
        $opcoes = $this->getDI()->getShared('ecommerce_options');
        foreach ($itens as $key => $value) {
            $this->pedido_id = $pedido_id;
            $this->produto_id = $value->id;
            $this->quantidade = $value->quantity;
            $this->valor = $value->price;
            if($opcoes->produto_detalhes == '1'){
                $this->detalhe_id = $value->options['detalhe_id'];
            }
            $this->save();
        }
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PedidoItens
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
