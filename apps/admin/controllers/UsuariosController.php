<?php
namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Usuarios;
use Ecommerce\Admin\Models\Clientes;
use Ecommerce\Admin\Models\Enderecos;
class UsuariosController extends ControllerBase
{

    public function indexAction($nivel)
    {
    	$niveis = ($nivel == 2) ? '1,2' : $nivel; 
  	   	$this->view->dados = Usuarios::find("nivel_id in ($niveis)");
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
}

