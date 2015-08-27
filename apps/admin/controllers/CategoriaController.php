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
    		$this->save($model);
    	}
    }

    public function updateAction($id){
        $this->view->categorias =  Categorias::getDados();
        $model = Categorias::findById($id);
        $this->view->form = new CategoriaForm($model,array('edit' => true));
        if($this->request->isPost()) {
            $this->save($model);
        }
    }

    public function deleteAction($id){
        $categoria = Categorias::findById($id);
        if($categoria->delete()){
            $this->flash->success("Deletado com sucesso");
        }else{
            $this->flash->error("Erro ao deletar sucesso");
        }
        return $this->response->redirect("admin/categorias");
    }

     protected function save($model){
        $model->nome = $this->request->getPost('nome');
        if($this->request->getPost('parent') != ''){
            $model->parent = $this->request->getPost('parent');
        }
        if($model->save()){
            $this->flash->success("Adicionado com sucesso");
        }else{
            $this->flash->success("Houve um erro");
        }
        return $this->response->redirect("admin/categorias");
    }
}

