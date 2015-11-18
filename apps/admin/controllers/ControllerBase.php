<?php

namespace Ecommerce\Admin\Controllers;

use Phalcon\Mvc\Controller;
use Ecommerce\Loja\Helpers\BaseHelper;
class ControllerBase extends Controller
{

	public $atributos;
	public $helper;
	
	public function initialize(){
		$this->helper = new BaseHelper;
		$this->view->setTemplateAfter('main');
		if (!$this->session->has("admin_logado")){
			$this->flashSession->error('Acesso negado : Faça o login para proseguir');
			$this->dispatcher->forward(array(
	       	 	'action' => 'index',
	       	 	'controller' => 'login',
	    	));
		}
		$attrs = ($this->ecommerce_options->produto_detalhes == '1') ? unserialize($this->ecommerce_options->produto_detalhe_options) : array();
		if($this->ecommerce_options->produto_options != ''){
			$produto_variacao = unserialize($this->ecommerce_options->produto_options);
			if($produto_variacao[0]['referencia'] != ''){
				$attrs = array_merge($attrs,$produto_variacao);
			}
		}
		$this->atributos = $attrs;
		$this->view->atributos = $this->atributos;
		$this->view->base_helper = $this->helper;
	}

	public function notifica($exec,$array){
		if($exec){
            $this->flashSession->success('Ação realizada com sucesso');
        }else{
            $mensagem = '';
            foreach ($robot->getMessages() as $message) {
                $mensagem .= $message.'\n';
            }
            $this->flashSession->error('Houve um erro :'.$mensagem);
        }
       	$this->dispatcher->forward($array);

	}
}
