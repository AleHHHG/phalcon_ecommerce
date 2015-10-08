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
use Ecommerce\Admin\Models\Notificacoes;
use Ecommerce\Loja\Forms\CheckOutForm;
class CheckoutController extends ControllerBase
{
	public function initialize(){
		$this->getTemplateFiles();
	}

	public function indexAction(){
		if(!$this->session->has("logado")){
			$this->session->set('checkout',true);
			return $this->response->redirect('user/login');
		}
		$cart = new Cart(new Session, new Cookie);
		$this->view->subtotal = number_format($cart->total(),2,',','.');
		if($this->session->has('frete')){
			$this->view->frete = number_format($this->session->get('frete')['valor'],2,',','.');
		}
		$this->view->endereco_form = new CheckOutForm();
		$this->view->total = number_format($cart->total() + $this->session->get('frete')['valor'],2,',','.');
		$widgets = Widgets::find("tipo_id = 1 AND ativo = 1 AND valor_minimo <=  {$cart->total()} ");
		$this->view->widgets = array_map(array($this,'setForms'),$widgets->toArray());
	}

	public function finalizarAction(){
		$cart = new Cart(new Session, new Cookie);
		//Cria o Pedido
		$pedido = new Pedidos();
		$pedido_id = $pedido->createData($cart,$this->request->getPost());
		//Cria os Itens do Pedido
		$pedido_itens = new PedidoItens();
		$pedido_itens = $pedido_itens->createData($cart->contents(),$pedido_id);
		//Envia Email
		$this->mailer->getHelper(array(
			'pedido_id' => $pedido_id,
			'tipo' => 'pedidoCriado'
		));

		$widget = Widgets::findFirst("id = {$this->request->getPost('forma_pagamento')}")->toArray();
		$_POST['pagamento']['valor'] = number_format($cart->total() + $this->session->get('frete')['valor'],2,'','');
		$_POST['pagamento']['pedido_id'] = $pedido_id;
		$_POST['pagamento']['url_base'] = $this->ecommerce_options->url_base;
		//Inicia o pagamento
		$pagamento = '\\'.$widget['namespace'].'\Pagamento';
		$retorno = $pagamento::init(false,$this->request->getPost('pagamento'),unserialize($widget['opcoes']));
		// Retorno do PAGAMENTO
		$class = '\\'.$widget['namespace'].'\Retorno';
		$class::init($retorno,$pedido_id);
		//Destroy Cart
		$this->verificaStatus($pedido_id);
	}

	public function confirmacaoAction($pedido){
		$this->view->pedido = Pedidos::findFirst("id = $pedido");
	}

	public function notificacaoAction($metodo){
		if($metodo == 'pagseguro'){
			$retorno = Notificacoes::retornoPagseguro($_POST);
			if($retorno != 0){
				$this->verificaStatus($retorno,false)
			}
		}
	}

	public function setForms($array){
		if($array['formulario']){
			$namespace = '\\'.$array['namespace'].'\Formulario';
			$array['form'] = $namespace::generate(unserialize($array['opcoes']));
		}
		return $array;
	}

	protected function verificaStatus($pedido_id,$redirect = true){
		$pedido = Pedidos::findFirst('id = '.$pedido);
		if($pedido->status_id == 3){
			$tipo = 'pedidoAprovado';
			$cart->destroy();
			$this->mailer->getHelper(array(
				'pedido_id' => $pedido_id,
				'tipo' => $tipo
			));
			if($redirect){
				return $this->response->redirect("checkout/confirmacao/$pedido_id");
			}
		}
		else if($pedido->status_id == 6 || $pedido->status_id == 7){
			$tipo = 'pedidoCancelado';
			$this->mailer->getHelper(array(
				'pedido_id' => $pedido_id,
				'tipo' => $tipo
			));
			if($redirect){
				$this->flashSession->error('Pedido CANCELADO/NÃO AUTORIZADO tente com nova forma de pagamento');
				return $this->response->redirect("checkout");
			}
		}
	}
}
