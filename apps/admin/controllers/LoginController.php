<?php

namespace Ecommerce\Admin\Controllers;

use Phalcon\Mvc\Controller;
use Ecommerce\Admin\Models\Usuarios;
class LoginController extends Controller
{

	function initialize(){
		$this->view->setTemplateAfter('login');
	}

    public function indexAction()
    {	
		if ($this->session->has("admin_logado")){
			$this->dispatcher->forward(array(
           	 	'controller' => 'index',
           	 	'action' => 'index',
        	));
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
				$this->session->set("admin_nivel",$user->nivel_id);
				$this->dispatcher->forward(array(
	           	 	'controller' => 'index',
	           	 	'action' => 'index',
	        	));
            }else{
            	$this->flashSession->error('Senha inválida');
				$this->dispatcher->forward(array(
		       	 	'action' => 'index',
		    	));
            }
        }else{
        	$this->flashSession->error('Usuário não existe em nossos registros');
        	$this->dispatcher->forward(array(
       	 		'action' => 'index',
    		));
        }
    }

    public function logoutAction(){
		$this->session->remove("admin_logado");
		$this->session->remove("admin_id");
		$this->session->remove("admin_email");
		$this->session->remove("admin_nome");
		$this->session->remove("admin_nivel");
		$this->dispatcher->forward(array(
       	 	'action' => 'index',
    	));
    }


}

