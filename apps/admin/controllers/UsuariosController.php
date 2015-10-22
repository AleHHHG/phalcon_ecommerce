<?php
namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Usuarios;
use Ecommerce\Admin\Forms\UsuarioForm;
use Ecommerce\Admin\Models\Clientes;
use Ecommerce\Admin\Models\Enderecos;
class UsuariosController extends ControllerBase
{

    public function indexAction($nivel)
    {
    	$niveis = ($nivel == 2) ? '2' : $nivel; 
  	   	$this->view->dados = Usuarios::find("nivel_id = $niveis ");
    	$this->view->nivel = $nivel;
    }

    public function showAction($id)
    {
        $this->view->dados = Usuarios::findFirst("id = $id");
        if($this->view->dados->nivel_id == 3){
        	$this->view->cliente = Clientes::findFirst("usuario_id = $id");
	        $this->view->endereco = Enderecos::findFirst("id_relacao = {$this->view->cliente->id} AND relacao = 'clientes'");
        }
    }

     public function createAction(){
        $this->view->form = new UsuarioForm();
        if($this->request->isPost()){
            $model = new Usuarios();
            $this->save($model,true);
        }
    }

    public function updateAction($id){
        $model = Usuarios::findFirst($id);
        $this->view->form = new UsuarioForm($model,array('edit' => true));
        $this->view->dados = $model;
        if($this->request->isPost()){
            $this->save($model);
        }
    }

    public function deleteAction($id){
        $model = Usuarios::findById($id);
        $exec = $model->delete();
        return $this->response->redirect('admin/usuarios/2');
    }

    protected function save($model,$create = false){
        foreach ($_POST as $key => $value) {
            $model->$key = $this->request->getPost($key);
        }
        $model->nivel_id = 2;
        if($create){
            $model->senha = $this->security->hash('user2015');
        }
        $exec = $model->save();
        return $this->response->redirect('admin/usuarios/2');
    }
}

