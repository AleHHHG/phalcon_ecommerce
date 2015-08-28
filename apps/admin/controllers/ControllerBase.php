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
		$attrs = ($this->ecommerce_options->produto_detalhes == '1') ? unserialize($this->ecommerce_options->produto_detalhe_options) : array();
		if($this->ecommerce_options->produto_options != ''){
			$attrs = array_merge($attrs,unserialize($this->ecommerce_options->produto_options));
		}
		$this->atributos = $attrs;
		$this->view->atributos = $this->atributos;
		$this->view->base_helper = $this->helper;
	}

	public function notifica($exec,$url){
		if($exec){
            $this->flashSession->success('Ação realizada com sucesso');
        }else{
            $mensagem = '';
            foreach ($robot->getMessages() as $message) {
                $mensagem .= $message.'\n';
            }
            $this->flashSession->error('Houve um erro :'.$mensagem);
        }
        return $this->response->redirect("$url");

	}
}
