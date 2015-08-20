<?php
namespace Ecommerce\Documentacao\Controllers;
use Ecommerce\Documentacao\Models\Documentacao;
use Ecommerce\Documentacao\Forms\DocumentacaoForm;
class IndexController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function showAction($id){
        $this->view->doc = Documentacao::findFirst($id);
        $this->view->childrens = Documentacao::find("parent = $id",array('column' => 'id,nome'))->toArray();
    }

    public function createAction(){
        $this->view->form = new DocumentacaoForm();
        if($this->request->isPost()) {
            $model = new Documentacao();
            $this->save($model);
        }
    }

    public function updateAction($id){
        $model = Documentacao::findFirst($id);
        $this->view->doc = $model;
        $this->view->form = new DocumentacaoForm($model,array('edit' => true));
        if($this->request->isPost()) {
            $this->save($model);
        }
    }

    public function deleteAction($id){
        $model = Documentacao::findFirst($id);
        if($model->delete()){
             $this->response->redirect('documentacao/show/'.$model->id);
        }
    }

    public function searchAction(){
    }

    protected function save($model){
        if($model->save($_POST)){
            $this->flash->success("Adicionado com sucesso");
        }else{
            $this->flash->success("Houve um erro");
        }
        $this->response->redirect('documentacao/show/'.$model->id);
    }
}