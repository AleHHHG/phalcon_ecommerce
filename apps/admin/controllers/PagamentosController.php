<?php

namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Widgets;
use Ecommerce\Admin\Forms\PagamentoForm;
class PagamentosController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->dados = Widgets::find('habilitado = 1 AND tipo_id = 1');
    }

    public function updateAction($id){
        $model = Widgets::findFirst($id);
        $this->view->form = new PagamentoForm($model,array('edit' => true));
        $this->view->pagamento = $model;
        if($this->request->isPost()){
            $this->save($model);
        }
    }

    protected function save($model){
        $opcoes = $this->request->getPost('opcoes');
        foreach ($_POST as $key => $value) {
            $model->$key = $this->request->getPost($key);
        }
        $model->valor_minimo = $this->Utilitarios->toFloat($this->request->getPost('valor_minimo'));
        $model->juros_parcela = $this->Utilitarios->toFloat($this->request->getPost('juros_parcela'));
        $model->valor_minimo_parcela = $this->Utilitarios->toFloat($this->request->getPost('valor_minimo_parcela'));
        $model->produtos = serialize($opcoes);
        $exec = $model->save();
        parent::notifica($exec,array('controller' => 'pagamentos','action' => 'index'));
    }



}

