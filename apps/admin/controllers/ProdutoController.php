<?php

namespace Ecommerce\Admin\Controllers;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Categorias;
use Ecommerce\Admin\Models\Imagens;
use Ecommerce\Admin\Forms\ProdutoForm;
use Ecommerce\Admin\Forms\ProdutoDetalheForm;
use Ecommerce\Admin\Forms\ProdutosRelacionadosForm;
class ProdutoController extends ControllerBase
{

    public function indexAction()
    {
  	   	$this->view->produtos = Produtos::find();
    }

    public function searchAction(){
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
        $this->view->relacionado_form = new ProdutosRelacionadosForm();
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
        $arr = array();
        if(!empty($produto->imagens)){
            $imagens = Imagens::find("id in (".implode(',', $produto->imagens).")");
            for ($i=0; $i < count($produto->imagens) ; $i++) { 
                foreach ($imagens as $key => $value) {
                    if($value->id == $produto->imagens[$i]){
                        $arr[] = $value;
                    }
                }
            }
        }
        $this->view->imagens = (object) $arr;
        $this->view->form = new ProdutoForm($produto,array('edit' => true));
        $this->view->relacionado_form = new ProdutosRelacionadosForm($produto,array('edit' => true));
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
        parent::notifica($exec,array('controller' => 'produto','action' => 'index'));
    }

   public function setCorAction(){
        if($this->request->isPost()) {
            if($this->request->isAjax()){
                $this->view->disable();
                $produto = Produtos::findById('560433b1b440b308090001c1');
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

    protected function save($produto){
        $imagens = $_POST['imagens'];
        $relacionados = $_POST['relacionado'];
        unset($_POST['relacionado']);
        unset($_POST['imagens']);
        foreach ($this->request->getPost() as $key => $value) {
            $produto->$key = $value;
        }
        if($imagens != ''){
            $produto->imagens = explode(',',$imagens);
        }else{
            $produto->imagens = array();
        }
        if($relacionados != ''){
            $produto->relacionados = array_unique(explode(',', $relacionados));
        }else{
            $produto->relacionados = array();
        }
        $exec = $produto->save();
        parent::notifica($exec,array('controller' => 'produto','action' => 'index'));
    }  
}

