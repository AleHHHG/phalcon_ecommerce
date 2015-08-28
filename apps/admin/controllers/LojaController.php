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
        $this->view->detalhe_opcoes = unserialize($this->ecommerce_options->produto_detalhe_options);
        $this->view->produto_opcoes = unserialize($this->ecommerce_options->produto_options);
        $this->view->form = new LojaProdutoForm($this->ecommerce_options,array('edit' => true));
        if($this->request->isPost()){
          $opcoes = $_POST['opcoes'];
          unset($_POST['opcoes']);
          $produto_opcoes = $_POST['produto_opcoes'];
          unset($_POST['produto_opcoes']);
          foreach ($_POST as $key => $value) {
              $option = Options::findFirst("nome = '$key'");
              $option->valor = $value;
              $option->update();
          }
          $this->customOptions($opcoes,'produto_detalhe_options');
          $this->customOptions($produto_opcoes,'produto_options');
          return $this->response->redirect("admin/loja/produtos");
      }
    }

    public function customOptions($array,$coluna){
      $arr = array();
      for ($i=0; $i < count($array['referencia']) ; $i++) {
        foreach ($array as $key => $value) {
          $arr[$i][$key] = $value[$i];
        }
      }
      $option = Options::findFirst("nome = '$coluna'");
      $option->valor = serialize($arr);
      $option->update();
    }

   

}