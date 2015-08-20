<?php

namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Forms\LojaGeralForm;
use Ecommerce\Admin\Forms\LojaProdutoForm;
use Ecommerce\Admin\Models\Options;
class LojaController extends ControllerBase
{
    public function geralAction()
    {
  	   	$this->view->form = new LojaGeralForm($this->ecommerce_options,array('edit' => true));
  	   	if($this->request->isPost()){
            foreach ($_POST as $key => $value) {
              $option = Options::findFirst("nome = '$key'");
              $option->valor = $value;
              $option->update();
            }
            return $this->response->redirect("admin/loja/geral");
    	  }
    }

     public function produtosAction()
    {
        $opcoes = $this->getDI()->getShared('ecommerce_options');
        $this->view->detalhe_opcoes = unserialize(Options::findFirst("nome = 'produto_detalhe_options'")->valor);
        $this->view->form = new LojaProdutoForm($opcoes,array('edit' => true));
        if($this->request->isPost()){
          $opcoes = $_POST['opcoes'];
          unset($_POST['opcoes']);
          foreach ($_POST as $key => $value) {
              $option = Options::findFirst("nome = '$key'");
              $option->valor = $value;
              $option->update();
          }
          $arr = array();
          for ($i=0; $i < count($opcoes['referencia']) ; $i++) {
            foreach ($opcoes as $key => $value) {
              $arr[$i][$key] = $value[$i];
            }
          }
          $option = Options::findFirst("nome = 'produto_detalhe_options'");
          $option->valor = serialize($arr);
          $option->update();
          return $this->response->redirect("admin/loja/produtos");
      }
    }

   

}