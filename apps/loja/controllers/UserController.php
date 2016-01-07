<?php
namespace Ecommerce\Loja\Controllers;
use Phalcon\Mvc\Controller;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Usuarios;
use Ecommerce\Admin\Models\Pedidos;
use Ecommerce\Admin\Models\Avaliacoes;
use Ecommerce\Admin\Models\Clientes;
use Ecommerce\Loja\Forms\ClienteForm;
use Ecommerce\Admin\Models\Enderecos;
use Ecommerce\Loja\Helpers\BaseHelper;
use Ecommerce\Admin\Models\Mailer;
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
                		$this->setSession($user);
                		if($this->session->has('checkout')){
                			$this->session->remove('checkout');
                			return $this->response->redirect("checkout");
                		}else{
                			$this->dispatcher->forward(array(
				           	 "action" => "index"
				        	));
                		}
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
		$base = new BaseHelper;
		$documento = $base->limpaString($this->request->getPost('documento'));
		if(!empty(Usuarios::findFirst('email = "'.$this->request->getPost('email').'"'))){
			$this->flashSession->error('E-mail já existem em nossa base de dados');
			return $this->response->redirect("user/login");
		}else if(!empty(Clientes::findFirst('documento = "'.$documento.'"'))){
			$this->flashSession->error('Já existe um usário com esse CPF cadastrado em nossa base');
			return $this->response->redirect("user/login");
		}
		$usuario = new Usuarios;
		$usuario->email = $this->request->getPost('email');
		$usuario->nome = $this->request->getPost('nome') ." ". $this->request->getPost('sobrenome');		
		$usuario->nivel_id = 3;
		$usuario->senha = $this->security->hash($this->request->getPost('senha'));
		if($usuario->save()){
			$cliente = new Clientes;
			$cliente->usuario_id = $usuario->id;
			$cliente->documento = $documento;
			$cliente->save();
			$this->setSession($usuario);
			return $this->response->redirect("user/edit/dados");
		}else{
			$mensagem = '';
			foreach ($usuarios->getMessages() as  $value) {
				$mensagem .= $message->getMessage()."<br/>";
			}
			$this->flashSession->error('Houve um erro:'.$mensagem);
			return $this->response->redirect("user/login");
		}

	}

	public function recuperaAction(){
		$base = new BaseHelper;
		$documento = $base->limpaString($this->request->getPost('documento'));
		$senha = $base->geraSenha(6);
		if($this->request->isPost()){
			$this->view->disable();
			$cliente = Clientes::findFirst('documento = "'.$documento.'"');
			if(!empty($cliente)){
				$array = array(
	                'email' => $cliente->Usuario->email,
	                'assunto' => 'Reucuperação senha '.$this->ecommerce_options->titulo,
	                'conteudo' => '<h2>Olá <strong>'.$cliente->Usuario->nome.'</strong></h2><br/> Sua nova senha é <strong>'.$senha.'</strong> acesse aréa restrita no link abaixo. <br/><br/> <a href="'.$this->ecommerce_options->url_base.'user/login">Minha Conta</a>',
	            );
				$usuario = Usuarios::findFirst('id ='.$cliente->usuario_id);
				$usuario->senha = $this->security->hash($senha);
	            if($usuario->save()){
	            	$email = new Mailer($this->ecommerce_options,$array);
	            	$email->send();	
	            	$this->response->setContent(json_encode(array('status' => true,'mensagem' => 'Você receberá um e-mail com as instruções da recuperação da senha')));
	            }else{
	            	$this->response->setContent(json_encode(array('status' => false,'mensagem' => 'Não foi possivel alterar a senha')));
	            }
	        }else{
	        	$this->response->setContent(json_encode(array('status' => false,'mensagem' => 'Não encontramos nenhum usuário com CPF informado')));
	        }
	        return $this->response;
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

	public function detalhesAction($id){
		$this->view->selecionado == 'Meus Pedidos';
		$this->view->pedido = Pedidos::findFirst("id = $id");
		$this->view->pedido_itens = PedidoItens::find("pedido_id = $id");
    	$this->view->endereco = Enderecos::findFirst("id_relacao = $id and relacao = 'pedidos'");
	}

	public function avaliacoesAction(){
		$this->view->selecionado == 'Minhas Avaliacoes';
		$this->view->avaliacoes = Avaliacoes::findWithProduto($this->session->get('id'));
	}


	public function editAction($param){
		$this->view->param = $param;
		if($param == 'dados'){
			$cliente = Clientes::findFirst('usuario_id ='.$this->session->get('id'));
			$this->view->form = new ClienteForm($cliente,array('edit' => true));
		}
		if($this->request->isPost()){
			$this->update($this->request->getPost(),$param);
		}
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
			$base = new BaseHelper;
			$cliente = Clientes::findFirst('usuario_id ='.$this->session->get('id'));
			$user->nome = $post['nome'];
			$user->save();
			$this->setSession($user);
			$cliente->telefone = $post['telefone'];
			$cliente->celular = $post['celular'];
			$cliente->documento = $base->limpaString($post['documento']);
			$cliente->save();
			$this->flashSession->success("Editado com sucesso");
			return $this->response->redirect("user/edit/$param");
		}
	}

	protected function setSession($user){
		$this->session->set("id", $user->id);
     	$this->session->set("email", $user->email);
     	$this->session->set("nome", $user->nome);
     	$this->session->set("logado", true);
	}
}
