<?php
namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Newsletter;
class NewsletterController extends ControllerBase
{

    public function indexAction()
    {
  	   	$this->view->dados = Newsletter::find();
    }

    public function xlsFormat(){
    	
    }
}

