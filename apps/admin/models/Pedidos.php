<?php
namespace Ecommerce\Admin\Models;
use Ecommerce\Admin\Models\Enderecos;
use Ecommerce\Admin\Models\Widgets;
use Phalcon\Mvc\Model\Query;
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
     *
     * @var string
     */
    public $link;

    /**
     *
     * @var integer
     */
    public $meio_pagamento;

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
        $this->data = date('Y-m-d H:i:s');
        if($this->save()){
            $endereco = new Enderecos;
            $endereco->relacao = 'pedidos';
            $endereco->id_relacao = $this->id;
            $endereco->estado_id = Estados::findFirst('sigla = "'.$post['endereco']['estado'].'"')->id;
            $endereco->cidade_id = Cidades::findFirst('nome = "'.$post['endereco']['cidade'].'"')->id;
            $endereco->cep = $post['endereco']['cep'];
            $endereco->logradouro = $post['endereco']['logradouro'];
            $endereco->bairro = $post['endereco']['bairro'];
            $endereco->numero = $post['endereco']['numero'];
            $endereco->complemento = $post['endereco']['complemento'];
            $endereco->save();
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

    public static function getEstatisticas($tipo,$periodo = array()){
        if($tipo == 'pedido'){
            return self::getEstatisticasPedido($periodo);
        }elseif($tipo == 'estado'){
            return self::getEstatisticasEstado($periodo);
        }else{
            return self::getEstatisticasPagamento($periodo);
        }
    }

    public function getEstatisticasVenda($periodo = array()){
        $manager = $this->getDI()->getShared('modelsManager');
        if(!empty($periodo)){
            $query  = $manager->createQuery('SELECT DATE_FORMAT(data,"%d/%m/%y") as data,count(*) as total FROM Ecommerce\Admin\Models\Pedidos WHERE status_id in (3,4,5) AND data >= "'.$periodo['inicial'].' 00:00:00" and data <= "'.$periodo['final'].' 23:59:59" GROUP BY DATE_FORMAT(data,"%Y-%m-%d") ORDER BY data ASC');
        }else{
            $query  = $manager->createQuery('SELECT DATE_FORMAT(data,"%d/%m/%y") as data,count(*) as total FROM Ecommerce\Admin\Models\Pedidos WHERE status_id in (3,4,5) GROUP BY DATE_FORMAT(data,"%Y-%m-%d") ORDER BY data ASC');
        }
        return $query->execute();
    }

    protected static function getEstatisticasPedido($periodo){
        if(!empty($periodo)){
            $s = 'AND data >= "'.$periodo['inicial'].' 00:00:00" and data <= "'.$periodo['final'].' 23:59:59"';
            $concluido = 'status_id in (3,4,5) ';
            $realizado = 'status_id in (1,2,6,7) ';
            $concluido .= $s;
            $realizado .= $s;
        }else{
            $concluido = 'status_id in (3,4,5)';
            $realizado = 'status_id in (1,2,6,7)';    
        }
        return array(
            'concluidos' => self::count(
                array(
                    "conditions" => $concluido               
                )
            ),
            'realizados' => self::count(
                array(
                    "conditions" => $realizado
                )
            ),
        );
    }

    protected static function getEstatisticasEstado($periodo){
        $endereco = Enderecos::count(
            array(
                'group'  => 'estado_id,id_relacao',
                'conditions' => 'relacao = "pedidos"'
            )
        );
        $arr = array();
        for ($i=0; $i < count($endereco) ; $i++) { 
            $sigla = Estados::findFirst('id = '.$endereco[$i]->estado_id)->sigla;
            if(!empty($periodo)){
                $pedido = self::findFirst($endereco[$i]->id_relacao)->toArray();
                if($pedido['data'] >= $periodo['inicial'].' 00:00:00' && $pedido['data'] <= $periodo['final'].' 23:59:59' ){
                   if(isset($arr[$sigla])){
                        $arr[$sigla] =  $arr[$sigla]+1;
                    }else{
                        $arr[$sigla] = $endereco[$i]->rowcount;
                    }
                }
            }else{
                if(isset($arr[$sigla])){
                    $arr[$sigla] =  $arr[$sigla]+1;
                }else{
                    $arr[$sigla] = $endereco[$i]->rowcount;
                }
            }
        }
        return $arr;
    }

    protected static function getEstatisticasPagamento($periodo){
        if(!empty($periodo)){
            $conditions = 'status_id in (3,4,5) AND data >= "'.$periodo['inicial'].' 00:00:00" and data <= "'.$periodo['final'].' 23:59:59"';
        }else{
            $conditions = 'status_id in (3,4,5)';    
        }
        $dados = self::count(
            array(
                'group'  => 'forma_pagamento',
                'conditions' =>  $conditions
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
