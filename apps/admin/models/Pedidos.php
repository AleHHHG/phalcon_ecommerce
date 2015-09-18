<?php
namespace Ecommerce\Admin\Models;
use Ecommerce\Admin\Models\Enderecos;
use Ecommerce\Admin\Models\Widgets;
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

    public static function getEstatisticas($tipo){
        if($tipo == 'pedido'){
            return self::getEstatisticasPedido();
        }elseif($tipo == 'estado'){
            return self::getEstatisticasEstado();
        }else{
            return self::getEstatisticasPagamento();
        }
    }

    protected static function getEstatisticasPedido(){
        return array(
            'concluidos' => self::count(
                 array(
                    "conditions" => "status_id in (3,4,5)"
                )
            ),
            'realizados' => self::count(
                 array(
                    "conditions" => "status_id in (1,2,6,7)"
                )
            ),
        );
    }

    protected static function getEstatisticasEstado(){
        $endereco = Enderecos::count(
            array(
                'group'  => 'estado_id',
                'conditions' => 'relacao = "pedidos"'
            )
        );
        $arr = array();
        for ($i=0; $i < count($endereco) ; $i++) { 
            $arr[$i]['estado'] = Estados::findFirst('id = '.$endereco[$i]->estado_id)->sigla;
            $arr[$i]['quantidade'] = $endereco[$i]->rowcount;
        }
        return $arr;
    }

    protected static function getEstatisticasPagamento(){
        $dados = self::count(
            array(
                'group'  => 'forma_pagamento',
                'conditions' => 'status_id in (3,4,5)'
            )
        );
        $arr = array();
        for ($i=0; $i < count($dados) ; $i++) { 
            $arr[$i]['forma_pagamento'] = Widgets::findFirst('id = '.$dados[$i]->forma_pagamento)->nome;
            $arr[$i]['quantidade'] = $dados[$i]->rowcount;
        }
        return $arr;
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
