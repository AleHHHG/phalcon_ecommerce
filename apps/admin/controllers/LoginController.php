<?php

namespace Ecommerce\Admin\Controllers;

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{

	function initialize(){
		$this->view->setTemplateAfter('login');
	}

    public function indexAction()
    {
      	
    }


}

