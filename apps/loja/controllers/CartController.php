<?php
namespace Ecommerce\Loja\Controllers;
use Moltin\Cart\Cart;
use Moltin\Cart\Storage\Session;
use Moltin\Cart\Identifier\Cookie;
use Phalcon\Mvc\Controller;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\FreteTipos;
use Ecommerce\Loja\Helpers\BaseHelper;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;
use Correios\CalculoFrete;
class CartController extends ControllerBase
{
	public $cart;

	public function initialize(){
		parent::initialize();
		$this->cart = new Cart(new Session, new Cookie);
	}

	public function indexAction(){
		$this->view->cart = $this->cart;
	}

	public function fragmentAction(){
		$this->view->disableLevel(View::LEVEL_AFTER_TEMPLATE);
		$this->view->cart = $this->cart;
	}

	public function insertAction(){
		$this->view->disable();
		if($this->request->isPost()){
			$array = $this->setItem($this->request->getPost());
		    $this->cart->insert($array);
		    if ($this->request->isAjax()) {
		        $this->response->setContent(json_encode(array('status' => true,'mensagem' => 'Produto adicionado com sucesso')));
		        return $this->response;
		    }else{
		    	return $this->response->redirect("cart");
		    }
		}
	}	

	public function updateAction($identificador){
		$item = $this->cart->item($identificador);
		if($this->request->isPost()){
			$item->quantity = $this->request->getPost('quantidade');
			if($this->request->isAjax()){
				$this->view->disable();
				$this->response->setContent(json_encode(array('status' => true,'valor' => number_format($this->cart->total(),2,',','.'),'mensagem' => 'Alterado com sucesso','item_valor' =>number_format($item->total(),2,',','.'))));
		        return $this->response;
			}
		}
	}

	public function removeAction($identificador){
		$item = $this->cart->item($identificador);
		$item->remove();
		if($this->request->isAjax()){
			$this->view->disable();
			$this->response->setContent(json_encode(array('status' => true,'valor' => number_format($this->cart->total(),2,',','.'),'mensagem' => 'Produto removido com sucesso')));
	        return $this->response;
		}
	}

	public function destroyAction(){
		$this->cart->destroy();
	}

	public function calculoAction(){
		$this->view->disableLevel(View::LEVEL_AFTER_TEMPLATE);
		if($this->request->isPost()){
			if($this->request->getPost('action') == 'calculo'){
				$this->session->set('cep',$this->request->getPost('cep'));
				$calculo = new CalculoFrete($this->cart->contents(),$this->request->getPost('cep'),$this->ecommerce_options->cep);
				$this->view->calculo = $calculo->getFretes();
				$this->view->tipos = array_column(FreteTipos::find()->toArray(),'nome','codigo');
			}else{
				$this->session->set('frete',array('codigo' => $this->request->getPost('codigo'),'valor' => $this->request->getPost('valor')));
				return false;
			}
		}
	}

	private function setItem($array){
		$base = new BaseHelper;
		$produto = Produtos::findById($array['produto_id'])->toArray();
		$array['id'] = $array['produto_id'];
		$array['name'] = $produto['nome'];
		$array['quantity'] = $array['quantidade'];
		if(isset($array['detalhe_id']) && $array['detalhe_id'] != ''){
			$chave = $base->arrayMultiSearch($produto['detalhes'],'detalhe_id',$array['detalhe_id']);
			$array['options']['detalhe_id'] = 	$array['detalhe_id'];
			$array['price'] = $produto['detalhes'][$chave]['valor'];
		}else{
			$array['price'] = (isset($produto['valor'])) ? $produto['valor'] : $produto['detalhes'][0]['valor'];
		}
		unset($array['produto_id']);
		unset($array['detalhe_id']);
		return $array;
	}


}