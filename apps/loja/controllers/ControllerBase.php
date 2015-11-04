<?php

namespace Ecommerce\Loja\Controllers;
use Phalcon\Mvc\Controller;
use Ecommerce\Loja\Helpers\BaseHelper;
class ControllerBase extends Controller
{
	public function initialize(){
		$this->verificaAtivo();
		$this->view->setTemplateAfter('main');
		$this->getTemplateFiles();
		$this->view->marcas = \Ecommerce\Admin\Models\Marcas::find()->toArray();
	}
	
	public function getTemplateFiles(){
		$base = new BaseHelper;
		$this->view->css = $base->getFiles('css');
		$this->view->js = $base->getFiles('js');
	}

	public function verificaAtivo(){
		if($this->ecommerce_options->ativo == '0'){
			echo $this->view->getRender('index','desativado');		
			exit;
		}else if($this->ecommerce_options->manutencao == '1'){
			echo $this->view->getRender('index','manutencao');		
			exit;
		}
	}
}
