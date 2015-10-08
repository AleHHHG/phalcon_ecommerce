<?php
namespace Ecommerce\Loja\Controllers;
use Ecommerce\Admin\Models\Paginas;
class IndexController extends ControllerBase
{

    public function indexAction(){	
    }

    public function paginaAction($id)
    {	
    	$this->view->pagina = Paginas::findFirst('id ='.$id);
    }
}

