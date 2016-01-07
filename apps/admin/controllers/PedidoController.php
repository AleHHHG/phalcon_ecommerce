<?php

namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Pedidos;
use Ecommerce\Admin\Models\Enderecos;
use Ecommerce\Admin\Models\Clientes;
use Ecommerce\Admin\Models\PedidoStatus;
class PedidoController extends ControllerBase
{

    public function indexAction()
    {
    	$this->view->pedidos = Pedidos::find();
    }

    public function showAction($id){
    	$this->view->pedido = Pedidos::findFirst("id = $id");
        $this->view->pedido_itens = PedidoItens::find("pedido_id = $id");
    	$this->view->endereco = Enderecos::findFirst("id_relacao = $id and relacao = 'pedidos'");
    	$this->view->cliente = Clientes::findFirst("usuario_id = {$this->view->pedido->usuario_id}");
        $this->view->pedido_status = PedidoStatus::find(" id IN (4,5)");
    }

    public function updateAction(){
        $pedido = Pedidos::findFirst("id = {$this->request->getPost('id')}");
        $pedido->status_id = $this->request->getPost('status');
        if($pedido->save()) {
            $this->response->setContent(json_encode(array('status' => true,'mensagem' => 'Requisição realizada com sucesso')));
        }else{
            $this->response->setContent(json_encode(array('status' => false,'mensagem' => 'A solicitação não pode ser completada, tente novamente')));
        }
        return $this->response;
    }

}

