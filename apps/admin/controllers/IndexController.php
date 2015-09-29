<?php

namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Usuarios;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Pedidos;
use Ecommerce\Admin\Models\PedidoItens;
class IndexController extends ControllerBase
{

    public function indexAction()
    {
    	$this->view->numeros = array(
    		'produtos' => count(Produtos::find()),
    		'pedidos' => Pedidos::count(),
    		'total_vendas' => Pedidos::sum(
    			 array(
			        "column"     => "total",
			        "conditions" => "status_id in (3,4,5)"
			    )
    		),
    		'usuarios' => Usuarios::count('nivel_id = 3'),
    	);
    	$this->view->ultimos_pedidos = Pedidos::find(array('limit' => 10,'order' => 'data desc'));
        $this->view->pedidos = Pedidos::getEstatisticas('pedido');
        $this->view->mais_vendidos = PedidoItens::getMaisVendidos();
    }

    public function relatoriosAction(){
        if($this->request->isPost()){
            $array = $this->request->getPost();
        }else{
            $array = array();
        }
        $pedidos = New Pedidos;
        $this->view->vendas = $pedidos->getEstatisticasVenda($array);
        $this->view->mais_vendidos = PedidoItens::getMaisVendidos(30,$array);
        $this->view->pedidos = Pedidos::getEstatisticas('pedido',$array);
        $this->view->estados = Pedidos::getEstatisticas('estado',$array);
        $this->view->pagamento = Pedidos::getEstatisticas('pagamento',$array);
    }


}

