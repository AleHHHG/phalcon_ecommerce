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
        $this->view->pedidos = array(
            'concluidos' => Pedidos::count(
                 array(
                    "conditions" => "status_id in (3,4,5)"
                )
            ),
            'realizados' => Pedidos::count(
                 array(
                    "conditions" => "status_id in (1,2,6,7)"
                )
            ),
        );
        $this->view->mais_vendidos = PedidoItens::getMaisVendidos();
    }


}

