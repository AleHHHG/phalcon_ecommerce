<?php
namespace Ecommerce\Loja\Controllers;
use Phalcon\Mvc\Controller;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Usuarios;
use Ecommerce\Admin\Models\Pedidos;
use Ecommerce\Admin\Models\Avaliacoes;
use Ecommerce\Admin\Models\Clientes;
class UserController extends ControllerBase
{

	public function indexAction(){
		$this->view->selecionado == 'Minha Conta';
		$this->view->pedidos = Pedidos::find(
			array(
				"usuario_id = {$this->session->get('id')}",
				'order' => 'id DESC',
				'limit' => 5
			)
		);
		$this->view->avaliacoes = Avaliacoes::findWithProduto($this->session->get('id'),5);
	}

	public function callbackAction(){
		$fb = new \Facebook\Facebook([
		  'app_id' => "{$this->ecommerce_options->facebook_appId}",
		  'app_secret' => "{$this->ecommerce_options->facebook_appSecret}",
		  'default_graph_version' => 'v2.2',
	  	]);
	  	$helper = $fb->getRedirectLoginHelper();
	  	$accessToken = $helper->getAccessToken();
		try {
		  // Returns a `Facebook\FacebookResponse` object
		  $response = $fb->get('/me?fields=id,name,email',$accessToken);
		} catch(\Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(\Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		$profile = $response->getGraphUser();
		$user = Usuarios::findFirst("uid = '{$profile['id']}'");
		if(!empty($user)){
			$this->setSession($user);
			$this->dispatcher->forward(array(
	            "action" => "index"
	        ));
		}else{
			$usuario = new Usuarios;
			$usuario->email = $profile['email'];
			$usuario->nome = $profile['name'];
			$usuario->nivel_id = 3;
			$usuario->uid = $profile['id'];
			if($usuario->save()){
				$cliente = new Clientes;
				$cliente->usuario_id = $usuario->id;
				$cliente->save();
				$this->setSession($usuario);
				$this->dispatcher->forward(array(
		            "action" => "index"
		        ));
			}else{
				$mensagem = '';
				foreach ($usuarios->getMessages() as  $value) {
					$mensagem .= $message->getMessage()."<br/>";
				}
				$this->flashSession->error('Houve um erro:'.$mensagem);
				return $this->response->redirect("user/login");
			}
		}
}

	public function loginAction(){
		$fb = new \Facebook\Facebook([
		  'app_id' => "{$this->ecommerce_options->facebook_appId}",
		  'app_secret' => "{$this->ecommerce_options->facebook_appSecret}",
		  'default_graph_version' => 'v2.4',
		]);
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email'];
		$loginUrl = $helper->getLoginUrl("{$this->ecommerce_options->url_base}user/callback",$permissions);
		$this->view->facebook = htmlspecialchars($loginUrl);
		if($this->request->isPost()){
			$email = $this->request->getPost('email');
			$senha = $this->request->getPost('senha');
			$user = Usuarios::findFirst("email = '$email' and nivel_id = 3");
			if($user){
	            if($this->security->checkHash($senha, $user->senha)) {
                		$this->setSession($user->id);
	                 	$this->dispatcher->forward(array(
				            "action" => "index"
				        ));
	            }else{
            		$this->flashSession->error("Senha Invalida");
            		return $this->response->redirect("user/login");
	            }
        	}else{
        		$this->flashSession->error("Nenhum usuario encontrado com o e-mail");
        		return $this->response->redirect("user/login");
        	}
		}
	}

	public function logoutAction(){
		$this->session->remove("id");
		$this->session->remove("email");
     	$this->session->remove("nome");
     	$this->session->remove("logado");
     	$this->dispatcher->forward(array(
            "action" => "login"
        ));
	}

	public function createAction(){
		if(!empty(Usuarios::findFirst('email = "'.$this->request->getPost('email').'"'))){
			$this->flashSession->error('E-mail já existem em nossa base de dados');
			return $this->response->redirect("user/login");
		}
		$usuario = new Usuarios;
		$usuario->email = $this->request->getPost('email');
		$usuario->nome = $this->request->getPost('nome');
		$usuario->nivel_id = 3;
		$usuario->senha = $this->security->hash($this->request->getPost('senha'));
		if($usuario->save()){
			$cliente = new Clientes;
			$cliente->usuario_id = $usuario->id;
			$cliente->save();
			$this->setSession($usuario);
			$this->dispatcher->forward(array(
	            "action" => "index"
	        ));
		}else{
			$mensagem = '';
			foreach ($usuarios->getMessages() as  $value) {
				$mensagem .= $message->getMessage()."<br/>";
			}
			$this->flashSession->error('Houve um erro:'.$mensagem);
			return $this->response->redirect("user/login");
		}

	}


	public function pedidosAction(){
		$this->view->selecionado == 'Meus Pedidos';
		$this->view->pedidos = Pedidos::find(
			array(
				"usuario_id = {$this->session->get('id')}",
				'order' => 'id DESC',
			)
		);
	}

	public function avaliacoesAction(){
		$this->view->selecionado == 'Minhas Avaliacoes';
		$this->view->avaliacoes = Avaliacoes::findWithProduto($this->session->get('id'));
	}


	public function editAction($param){
		$this->view->param = $param;
		if($this->request->isPost()){
			$this->update($this->request->getPost(),$param);
		}
	}

	public function insert(){

	}

	public function update($post,$param){
		$user = Usuarios::findFirstById($this->session->get('id'));
		if($param == 'password'){
			if($this->security->checkHash($post['senha_atual'], $user->senha)){
				if($post['senha'] == $post['repeat_senha']){
					$user->senha = $this->security->hash($post['senha']);
					$user->save();
					$this->flashSession->success("Editado com sucesso");
        			return $this->response->redirect("user/edit/$param");
				}else{
					$this->flashSession->error("Senhas não confrerem");
        			return $this->response->redirect("user/edit/$param");
				}
			}else{
				$this->flashSession->error("Senhas atual invalida ");
    			return $this->response->redirect("user/edit/$param");
			}
		}else{

		}
	}

	protected function setSession($user){
		$this->session->set("id", $user->id);
     	$this->session->set("email", $user->email);
     	$this->session->set("nome", $user->nome);
     	$this->session->set("logado", true);
	}
}
