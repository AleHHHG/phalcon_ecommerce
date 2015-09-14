<?php

namespace Ecommerce\Loja\Controllers;
use Phalcon\Mvc\Controller;
use Ecommerce\Loja\Helpers\BaseHelper;
class ControllerBase extends Controller
{
	public function initialize(){
		$this->view->setTemplateAfter('main');
		$this->getTemplateFiles();
		$this->view->marcas = \Ecommerce\Admin\Models\Marcas::find();
	}
	
	public function getTemplateFiles(){
		$base = new BaseHelper;
		$this->view->css = $base->getFiles('css');
		$this->view->js = $base->getFiles('js');
	}
}