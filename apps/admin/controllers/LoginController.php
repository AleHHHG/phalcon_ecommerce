<?php

namespace Ecommerce\Admin\Controllers;

use Phalcon\Mvc\Controller;
use Ecommerce\Admin\Models\Usuarios;
class LoginController extends Controller
{

	function initialize(){
		$string = 'ola';
		$string = ucwords($string);
		$this->view->setTemplateAfter('login');
	}

    public function indexAction()
    {	
		if ($this->session->has("admin_logado")){
			return $this->response->redirect('admin/dashboard');
		}
    }

    public function createAction(){
    	$user = Usuarios::findFirst("email = '{$this->request->getPost('email')}' and  nivel_id <> 3 ");
	 	if ($user) {
            if ($this->security->checkHash($this->request->getPost('password'), $user->senha)) {
                $this->session->set("admin_logado",true);
				$this->session->set("admin_id",$user->id);
				$this->session->set("admin_email",$user->email);
				$this->session->set("admin_nome",$user->nome);
				return $this->response->redirect('admin/dashboard');
            }else{
            	$this->flashSession->error('Senha inválida');
				return $this->response->redirect('admin');
            }
        }else{
        	$this->flashSession->error('Usuário não existe em nossos registros');
        	return $this->response->redirect('admin');
        }
    }

    public function logoutAction(){
		$this->session->remove("admin_logado");
		$this->session->remove("admin_id");
		$this->session->remove("admin_email");
		$this->session->remove("admin_nome");
		return $this->response->redirect('admin');
    }


}

