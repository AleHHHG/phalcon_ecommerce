<?php

namespace Ecommerce\Admin\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
	public function initialize(){
		$this->view->setTemplateAfter('main');
	}
}
