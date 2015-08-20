<?php

namespace Ecommerce\Loja\Controllers;
use Phalcon\Mvc\Controller;
use Ecommerce\Admin\Models\Produtos;
use Moltin\Cart\Cart;
use Moltin\Cart\Storage\Session;
use Moltin\Cart\Identifier\Cookie;
use Ecommerce\Admin\Models\Widgets;
use Ecommerce\Admin\Models\Enderecos;
use Ecommerce\Admin\Models\Pedidos;
use Ecommerce\Admin\Models\PedidoItens;
class CheckoutController extends ControllerBase
{
	public function initialize(){
		$this->getTemplateFiles();
	}

	public function indexAction(){
		$cart = new Cart(new Session, new Cookie);
		$this->view->subtotal = number_format($cart->total(),2,',','.');
		if($this->session->has('frete')){
			$this->view->frete = number_format($this->session->get('frete')['valor'],2,',','.');
		}
		$this->view->total = number_format($cart->total() + $this->session->get('frete')['valor'],2,',','.');
		$widgets = Widgets::find('tipo_id = 1 and ativo = 1');
		$this->view->widgets = array_map(array($this,'setForms'),$widgets->toArray());
	}

	public function finalizarAction(){
		$cart = new Cart(new Session, new Cookie);
		$pedido = new Pedidos();
		$pedido_id = $pedido->createData($cart,$this->request->getPost());
		$pedido_itens = new PedidoItens();
		$pedido_itens = $pedido_itens->createData($cart->contents(),$pedido_id);
		$widget = Widgets::findFirst("id = {$this->request->getPost('forma_pagamento')}")->toArray();
		$_POST['pagamento']['valor'] = number_format($cart->total() + $this->session->get('frete')['valor'],2,'','');
		$_POST['pagamento']['pedido_id'] = 1;
		$class = '\\'.$widget['namespace'].'\Pagamento';
		$retorno = $class::init(false,$this->request->getPost('pagamento'),unserialize($widget['opcoes']));
		$class = '\\'.$widget['namespace'].'\Retorno';
		$class::init($retorno,$pedido_id);
		return $this->response->redirect("checkout/confirmacao/$pedido_id");

	}

	public function confirmacaoAction($pedido){
		$this->view->pedido = Pedidos::findFirst("id = $pedido");
	}

	public function retornoAction(){

	}


	public function setForms($array){
		$namespace = '\\'.$array['namespace'].'\Formulario';
		if($array['formulario']){
			$array['form'] = $namespace::generate();
		}
		return $array;
	}
}
