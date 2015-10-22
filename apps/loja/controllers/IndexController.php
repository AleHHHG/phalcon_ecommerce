<?php
namespace Ecommerce\Loja\Controllers;
use Ecommerce\Admin\Models\Paginas;
use Ecommerce\Admin\Models\Newsletter;
class IndexController extends ControllerBase
{

    public function indexAction(){
    }

    public function paginaAction($id)
    {	
    	$this->view->pagina = Paginas::findFirst('id ='.$id);
    }

    public function newsletterAction()
    {	
        $this->view->disable();
        if($this->request->isPost()){
            $model = new Newsletter();
            $model->email = $this->request->getPost('email');
            if ($model->save()) {
                $this->response->setContent(json_encode(array('status' => true,'mensagem' => 'Cadastrado com sucesso, ')));
            }else{
                 $this->response->setContent(json_encode(array('false' => true,'mensagem' => 'Houve um erro e não pode ser completada sua requisão')));
            }
            return $this->response;
        }
    }
}

