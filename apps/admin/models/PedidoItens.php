<?php
namespace Ecommerce\Admin\Models;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Pedidos;
class PedidoItens extends \Phalcon\Mvc\Model
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
    public $produto_id;

    /**
     *
     * @var string
     */
    public $detalhe_id;

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

    public static function getMaisVendidos($limit = 10,$periodo = array()){
        $produtos = self::sum(
            array(
                "column" => "quantidade",
                "group"  => "produto_id,pedido_id",
                "order"  => "sumatory DESC",
                "limit" => $limit,
            )
        );
        $arr = array();
        for ($i=0; $i < count($produtos) ; $i++) { 
            if(!empty($periodo)){
                $pedido = Pedidos::findFirst($produtos[$i]->pedido_id)->toArray();
                if($pedido['data'] >= $periodo['inicial'].' 00:00:00' && $pedido['data'] <= $periodo['final'].' 23:59:59' ){
                    $arr[$i]['produto'] = Produtos::findById( $produtos[$i]->produto_id)->nome;
                    $arr[$i]['quantidade'] = $produtos[$i]->sumatory;
                }
            }else{
                $arr[$i]['produto'] = Produtos::findById( $produtos[$i]->produto_id)->nome;
                $arr[$i]['quantidade'] = $produtos[$i]->sumatory;
            }
        }
        return $arr;
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
            $pi = new PedidoItens;
            $pi->pedido_id = $pedido_id;
            $pi->produto_id = $value->id;
            $pi->quantidade = $value->quantity;
            $pi->valor = $value->price;
            if($opcoes->produto_detalhes == '1'){
                $pi->detalhe_id = $value->options['detalhe_id'];
            }
            $pi->save();
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
