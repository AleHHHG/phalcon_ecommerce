<?php

namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Categorias;
use Ecommerce\Admin\Models\Imagens;
use Ecommerce\Admin\Forms\ProdutoForm;
use Ecommerce\Admin\Forms\ProdutoDetalheForm;
class ProdutoController extends ControllerBase
{

    public function indexAction()
    {
  	   	$this->view->produtos = Produtos::find();
        if($this->request->isPost()) {
            $this->view->disable();
            $arr = array();
            $param =  $this->request->getPost('q');
            $produtos = Produtos::find(array('conditions' => array('nome' =>  new \MongoRegex("/$param/i")))); 
            foreach ($produtos  as $key => $value) {
                $arr[$key]['id'] =  (string) $value->_id;
                $arr[$key]['name'] =  $value->nome;
            }
            $this->response->setHeader("Content-Type", "application/json"); 
            return $this->response->setContent(json_encode($arr));
        }
    }


    public function createAction(){
        $this->view->categorias =  Categorias::getDados();
        $this->view->form = new ProdutoForm();
        if($this->ecommerce_options->produto_detalhes == '1'){
             $this->view->form_detalhes = new ProdutoDetalheForm();
        }
        if($this->request->isPost()) {
           $model = new Produtos();
           $this->save($model);
        }

    }

    public function updateAction($id){
        $this->view->categorias =  Categorias::getDados();
        $produto = Produtos::findById($id);
        $this->view->imagens = Imagens::find("id in (".implode(',', $produto->imagens).")");
        $this->view->form = new ProdutoForm($produto,array('edit' => true));
        $form = array();
        if($this->ecommerce_options->produto_detalhes == '1'){
            foreach ($produto->detalhes as $key => $value) {
                $form[] = new ProdutoDetalheForm((object)$value,array('edit' => true));
            }
            $this->view->form_detalhes = $form;
        }
        if($this->request->isPost()){
            $this->save($produto);
        }
        $this->view->produto = $produto;
    }

    public function deleteAction($id){
        $produto = Produtos::findById($id);
        $exec = $produto->delete();
        parent::notifica($exec,"admin/produtos");
    }

    protected function save($produto){
        $imagens = $_POST['imagens'];
        $relacionados = $_POST['relacionados'];
        unset($_POST['relacionados']);
        unset($_POST['imagens']);
        foreach ($this->request->getPost() as $key => $value) {
            $produto->$key = $value;
        }
        if($imagens != ''){
            $produto->imagens = explode(',',$imagens);
        }
        if($relacionados != ''){
            $produto->relacionados = array_unique(explode(',', $relacionados));
        }
        $exec = $produto->save();
        parent::notifica($exec,"admin/produtos");
    }  
}

