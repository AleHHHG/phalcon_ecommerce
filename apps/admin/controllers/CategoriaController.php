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
    	$this->view->form = new CategoriaForm();
    	if($this->request->isPost()) {
    		$model = new Categorias();
    		$this->save($model);
    	}
    }

    public function updateAction($id){
        $model = Categorias::findById($id);
        $this->view->categoria = $model;
        $this->view->categorias = Categorias::returnArrayForSelect();
        $this->view->form = new CategoriaForm($model,array('edit' => true));
        if($this->request->isPost()) {
            $this->save($model);
        }
    }

    public function deleteAction($id){
        $categoria = Categorias::findById($id);
        $exec = $categoria->delete();
        parent::notifica($exec,array('controller' => 'categoria','action' => 'index'));
    }

     protected function save($model){
        $model->nome = $this->request->getPost('nome');
        if($this->request->getPost('parent') != ''){
            $model->parent = $this->request->getPost('parent');
        }
        $exec = $model->save();
        parent::notifica($exec,array('controller' => 'categoria','action' => 'index'));
    }
}

