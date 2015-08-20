<?php

namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Categorias;
use Ecommerce\Admin\Forms\CategoriaForm;
class CategoriaController extends ControllerBase
{

    public function indexAction()
    {
  	   	$this->view->categorias =  Categorias::getDados();
    }

    public function createAction(){
		$this->view->categorias =  Categorias::getDados();
    	$this->view->form = new CategoriaForm();
    	if($this->request->isPost()) {
    		$model = new Categorias();
    		$model->nome = $this->request->getPost('nome');
    		if($this->request->getPost('parent') != ''){
    			$model->parent = $this->request->getPost('parent');
    		}
    		if($model->save()){
                $this->flash->success("Adicionado com sucesso");
    			return $this->response->redirect("admin/categorias");
    		}
    	}
    }

    public function editAction($id){
        $this->categoria = Categorias::findById($id);
    }

    public function deleteAction($id){
        $categoria = Categorias::findById($id);
        if($categoria->delete()){
            $this->flash->success("Adicionado com sucesso");
        }else{
            $this->flash->error("Adicionado com sucesso");
        }
        return $this->response->redirect("admin/categorias");
    }


}

