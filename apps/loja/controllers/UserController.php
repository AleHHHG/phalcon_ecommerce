<?php
namespace Ecommerce\Loja\Controllers;
use Phalcon\Mvc\Controller;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Usuarios;
use Ecommerce\Admin\Models\Pedidos;
use Ecommerce\Admin\Models\Avaliacoes;
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

	public function loginAction(){
		if($this->request->isPost()){
			$email = $this->request->getPost('email');
			$senha = $this->request->getPost('senha');
			$user = Usuarios::findFirst("email = '$email' and nivel_id = 3");
			if($user){
	            if($this->security->checkHash($senha, $user->senha)) {
                		$this->session->set("id", $user->id);
	                 	$this->session->set("email", $user->email);
	                 	$this->session->set("nome", $user->nome);
	                 	$this->session->set("logado", true);
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


	public function createAction(){

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
}
