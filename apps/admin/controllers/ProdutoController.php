<?php

namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Categorias;
use Ecommerce\Admin\Forms\ProdutoForm;
use Ecommerce\Admin\Forms\ProdutoDetalheForm;
class ProdutoController extends ControllerBase
{

    public function indexAction()
    {
  	   	$this->view->produtos = Produtos::find();
    }

    public function setCorAction(){
        if($this->request->isPost()) {
            if($this->request->isAjax()){
                $this->view->disable();
                $produto = Produtos::findById($this->request->getPost('produto'));
                if($this->request->getPost('cor') != ''){
                    if(isset($produto->imagem_detalhes) && !empty($produto->imagem_detalhes)){
                        foreach ($produto->imagem_detalhes as $key => $value) {
                            if($this->request->getPost('cor') != $key){
                                $arr = array_diff($produto->imagem_detalhes[$key], array($this->request->getPost('imagem')));
                                $produto->imagem_detalhes[$key] = $arr;
                            }
                        }
                    }
                    $produto->imagem_detalhes[$this->request->getPost('cor')][] =  $this->request->getPost('imagem'); 
                    $produto->save();
                }
            } 
        }

    }

    public function createAction(){
        $this->view->categorias =  Categorias::getDados();
        $this->view->form = new ProdutoForm();
        if($this->ecommerce_options->produto_detalhes == '1'){
             $this->view->form_detalhes = new ProdutoDetalheForm();
        }
        if($this->request->isPost()) {
            if($this->request->isAjax()){
                $this->view->disable();
                if($this->request->hasFiles() == true) {
                    $arr = $this->uploadeImagem();
                    if ($this->session->has("produto_imagens")) {
                        $imagens = $this->session->get("produto_imagens");
                        $arr = array_merge($imagens,$arr);
                        $this->session->set("produto_imagens", $arr);
                    }
                    $this->session->set("produto_imagens", $arr);
                }
            }else{
               $model = new Produtos();
               $this->save($model);
            }
        }

    }

    public function updateAction($id){
        $this->view->categorias =  Categorias::getDados();
        $produto = Produtos::findById($id);
        $this->view->form = new ProdutoForm($produto,array('edit' => true));
        $form = array();
        if($this->ecommerce_options->produto_detalhes == '1'){
            foreach ($produto->detalhes as $key => $value) {
                $form[] = new ProdutoDetalheForm((object)$value,array('edit' => true));
            }
            $this->view->form_detalhes = $form;
        }
        if($this->request->isPost()){
            if($this->request->isAjax()){
                $this->view->disable();
                if($this->request->hasFiles() == true) {
                    $arr = $this->uploadeImagem();
                    if(is_array($produto->imagens)){
                        for($i=0; $i < count($arr) ; $i++) { 
                            $produto->imagens[] =  $arr[$i];
                        } 
                    }else{
                        $produto->imagens = $arr;
                    }
                    $_POST = array();
                    $produto->save();
                }
            }else{
                $this->save($produto);
            }
        }
        $this->view->produto = $produto;
    }

    public function deleteAction($id){
        $produtos = Produtos::findById($id);
        if($produtos->delete()){
            $this->flash->success("Deletaco com sucesso");
        }else{
            $this->flash->error("Não foi possivel deletar");
        }
        return $this->response->redirect("admin/produtos");
    }

    protected function save($produto){
        foreach ($this->request->getPost() as $key => $value) {
            $produto->$key = $value;
        }
        if($this->dispatcher->getActionName() == 'create'){
            $produto->imagens = $this->session->get('produto_imagens');
            $this->session->remove("produto_imagens");
        }
        if($produto->save()){
            $this->flash->success("Adicionado com sucesso");
        }else{
            $this->flash->success("Houve um erro");
        }
        return $this->response->redirect("admin/produtos");
    }

    protected function uploadeImagem(){
        $arr = array();
        foreach ($this->request->getUploadedFiles() as $file) {
            //Print file details
            $arr[] = $file->getName();

            //Move the file into the application
            $file->moveTo('files/produtos/' . $file->getName());
        }
        return $arr;
    }


}

