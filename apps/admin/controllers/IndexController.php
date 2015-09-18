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
        $this->view->mais_vendidos = PedidoItens::getMaisVendidos(30);
        $this->view->pedidos = Pedidos::getEstatisticas('pedido');
        $this->view->estados = Pedidos::getEstatisticas('estado');
        $this->view->pagamento = Pedidos::getEstatisticas('pagamento');
    }


}

