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
            $arr[] = $file->getName();
            $file->moveTo('files/produtos/' . $file->getName());
        }
        return $arr;
    }

    public function integracaoAction(){
        // mysql_connect('mysql.maremansanautica.com.br','maremansanauti','mare2015') or die(mysql_error());
        // mysql_select_db('maremansanauti');
        // mysql_query("SET NAMES 'utf8'");
        // mysql_query("SET CHARACTER SET utf8 ");
        // $exec = mysql_query('SELECT produtos.*,produto_imagens.imagem_thumbnail FROM produtos LEFT JOIN produto_imagens ON produtos.produto_id = produto_imagens.imagem_id ');
        // $dados = array();
        // while ($row = mysql_fetch_assoc($exec)) {
        //     $dados[] = $row;
        // }
        // foreach ($dados as $key => $value) {
        //     $produto = new Produtos();
        //     $arr = array('conditions' => array());
        //     if($value['subcategoria_b_id'] != ''){
        //         $arr['conditions'] = array('id_externo' => $value['subcategoria_b_id']); 
        //         $categoria = Categorias::findFirst($arr);
        //         if(empty($categoria)){
        //             $arr['conditions'] = array('id_externo' => $value['subcategoria_id']); 
        //             $categoria =  Categorias::findFirst($arr);
        //         }
        //     }else if($value['subcategoria_id'] != ''){
        //         $arr['conditions'] = array('id_externo' => $value['subcategoria_id']); 
        //     }else{
        //         $arr['conditions'] = array('id_externo' => $value['categoria_id']) ; 
        //     }
        //     if(!isset($categoria)){
        //         $categoria = Categorias::findFirst($arr);
        //     }
        //     $produto->nome = $value['produto_nome'];
        //     $produto->descricao = $value['produto_descricao'];
        //     $produto->peso = ($value['produto_peso'] != 0) ? $value['produto_peso']/100 : 0.00;
        //     $produto->altura = 1;
        //     $produto->largura = 1;
        //     $produto->comprimento = 1;
        //     $produto->ativo = 1;
        //     $produto->detalhes = array(
        //         'valor' => $value['produto_valor'],
        //         'estoque' => 10,
        //     );
        //     $produto->id_externo = $value['produto_id'];
        //     $produto->categoria = (string) $categoria->_id;
        //     $produto->save();
        // }
        mysql_connect('localhost','root','2015') or die(mysql_error());
        mysql_select_db('mare_old');
        mysql_query("SET NAMES 'utf8'");
        mysql_query("SET CHARACTER SET utf8 ");
        $exec = mysql_query('SELECT tb_ic_explend_produtos.*,tb_ic_produtos.pro_destaque,tb_ic_produtos.pro_desc,tb_ic_produtos.pro_foto1,tb_ic_produtos.pro_foto2,tb_ic_produtos.pro_foto3,tb_ic_produtos.pro_foto4 FROM tb_ic_explend_produtos LEFT JOIN tb_ic_produtos ON tb_ic_produtos.pro_codexterno = tb_ic_explend_produtos.pro_id order by pro_nome asc') or die(mysql_error());
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

