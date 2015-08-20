<?php

namespace Ecommerce\Documentacao\Controllers;

use Phalcon\Mvc\Controller;
use Ecommerce\Documentacao\Models\Documentacao;
class ControllerBase extends Controller
{
	public function initialize(){
		$this->view->setTemplateAfter('main');
		$this->view->menu = Documentacao::find('parent = 0');
	}
}
