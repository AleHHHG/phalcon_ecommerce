<?php

namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Fretes;
use Ecommerce\Admin\Forms\FreteForm;
class FretesController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->dados = Fretes::find();
    }

    public function createAction(){
        $this->view->form = new FreteForm();
        if($this->request->isPost()){
            $model = new Fretes();
            $this->save($model);
        }
    }

    public function updateAction($id){
        $model = Fretes::findFirst($id);
        $this->view->form = new FreteForm($model,array('edit' => true));
        $this->view->frete = $model;
        if($this->request->isPost()){
            $this->save($model);
        }
    }

    public function deleteAction($id){
        $model = Fretes::findById($id);
        $exec = $model->delete();
        parent::notifica($exec,"admin/fretes");
    }

    protected function save($model){
        $produtos = $this->request->getPost('produtos');
        foreach ($_POST as $key => $value) {
            $model->$key = $this->request->getPost($key);
        }
        $model->valor_minimo = $this->Utilitarios->toFloat($this->request->getPost('valor_minimo'));
        if($produtos != ''){
            $model->produtos = serialize(array_unique(explode(',', $produtos)));
        }
        $exec = $model->save();
        parent::notifica($exec,"admin/fretes");
    }



}

