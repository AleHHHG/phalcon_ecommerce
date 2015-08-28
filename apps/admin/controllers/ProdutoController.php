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
        $exec = $produto->delete();
        parent::notifica($exec,"admin/produtos");
    }

    protected function save($produto){
        foreach ($this->request->getPost() as $key => $value) {
            $produto->$key = $value;
        }
        if($this->dispatcher->getActionName() == 'create'){
            $produto->imagens = $this->session->get('produto_imagens');
            $this->session->remove("produto_imagens");
        }
        $exec = $produto->save();
        parent::notifica($exec,"admin/produtos");
    }

    protected function uploadeImagem(){
        $arr = array();
        foreach ($this->request->getUploadedFiles() as $file) {
            $arr[] = $file->getName();
            $file->moveTo('files/produtos/' . $file->getName());
        }
        return $arr;
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

    public function integracaoAction(){
        mysql_connect('localhost','root','2015') or die(mysql_error());
        mysql_select_db('mare_old');
        mysql_query("SET NAMES 'utf8'");
        mysql_query("SET CHARACTER SET utf8 ");
        $exec = mysql_query('SELECT tb_ic_explend_produtos.*,tb_ic_produtos.pro_destaque,tb_ic_produtos.pro_desc,tb_ic_produtos.pro_foto1,tb_ic_produtos.pro_foto2,tb_ic_produtos.pro_foto3,tb_ic_produtos.pro_foto4 FROM tb_ic_explend_produtos LEFT JOIN tb_ic_produtos ON tb_ic_produtos.pro_codexterno = tb_ic_explend_produtos.pro_id') or die(mysql_error());
        $dados = array();
        while ($row = mysql_fetch_assoc($exec)) {
            $dados[] = $row;
        }
        foreach ($dados as $key => $value) {
            $produto = new Produtos();
            $arr = array('conditions' => array());
            if($value['pro_grupo2'] != ''){
                $arr['conditions'] = array('id_externo' => $value['pro_grupo2']); 
                $categoria = Categorias::findFirst($arr);
                if(empty($categoria)){
                    $arr['conditions'] = array('id_externo' => $value['pro_grupo1']); 
                    $categoria =  Categorias::findFirst($arr);
                }
            }else if($value['pro_grupo1']){
                $arr['conditions'] = array('id_externo' => $value['pro_grupo1']) ; 
                $categoria = Categorias::findFirst($arr);
            }else{
                echo "<pre>";
                echo $value['pro_nome'];
                die(print_r($value));
            }
            $produto->nome = $value['pro_nome'];
            $produto->descricao = $value['pro_desc'];
            $produto->peso = floatval($value['pro_peso']);
            $produto->altura = 1;
            $produto->largura = 1;
            $produto->comprimento = 1;
            $produto->ativo = ($value['pro_status'] == 'A') ? '1' : '0';
            $produto->destaque = ($value['pro_destaque'] == 'S') ? '1' : '0';
            $produto->detalhes = array(
                array(
                    'valor' => floatval($value['pro_preco']),
                    'estoque' => 10,
                    'detalhe_id' => (string) new \MongoId()
                )
            );
            $produto->id_externo = $value['pro_id'];
            $produto->categoria = (string) $categoria->_id;
            $dados = array();
            for ($i=1; $i <= 4 ; $i++) { 
                if($value['pro_foto'.$i]){
                    $dados[] = $value['pro_foto'.$i];
                }
            }
            $produto->imagens = $dados;
            $produto->save();
        }
    }


}

