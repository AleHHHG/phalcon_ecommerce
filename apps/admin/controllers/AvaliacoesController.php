<?php

namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Avaliacoes;
use Ecommerce\Admin\Models\Produtos;
class AvaliacoesController extends ControllerBase
{

    public function indexAction()
    {
  	   	$this->view->dados = Avaliacoes::find();
    }

    public function showAction($id)
    {
        $this->view->dados = Avaliacoes::findFirst("id = $id");
    	$this->view->produto = Produtos::findById($this->view->dados->produto_id);
    }

    public function updateAction($id)
    {
    	$this->view->disable();
        $avaliacao = Avaliacoes::findFirst("id = $id");
    	$avaliacao->aprovado = $_POST['aprovado'];
    	$avaliacao->save();
    }
}

