<?php

namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Cupons;
use Ecommerce\Admin\Forms\CupomForm;
class CupomController extends ControllerBase
{

    public function indexAction()
    {
  	   	$this->view->dados =  Cupons::find();
    }

    public function createAction(){
    	$this->view->form = new CupomForm();
    	if($this->request->isPost()) {
    		$model = new Cupons();
    		$this->save($model);
    	}
    }

    public function updateAction($id){
        $model = Cupons::findFirst('id ='.$id);
        $this->view->cupom = $model;
        $this->view->form = new CupomForm($model,array('edit' => true));
        if($this->request->isPost()) {
            $this->save($model);
        }
    }

    public function deleteAction($id){
        $model = Cupons::findById($id);
        $exec = $model->delete();
        parent::notifica($exec,"admin/cupons");
    }

     protected function save($model){
        $valor = $this->request->getPost('valor');
        $valor_minimo = $this->request->getPost('valor_minimo');
        unset($_POST['valor']);
        unset($_POST['valor_minimo']);
        foreach ($this->request->getPost() as $key => $value) {
            $model->$key = $value;
        }
        $model->valor = $this->Utilitarios->toFloat($valor);
        $model->valor_minimo = $this->Utilitarios->toFloat($valor_minimo);
        $exec = $model->save();
        parent::notifica($exec,"admin/cupons");
    }
}

