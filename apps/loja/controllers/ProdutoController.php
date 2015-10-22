<?php

namespace Ecommerce\Loja\Controllers;
use Phalcon\Mvc\Controller;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Categorias;
use Ecommerce\Admin\Models\Avaliacoes;
use Ecommerce\Admin\Models\Imagens;
use Ecommerce\Loja\Helpers\BaseHelper;
use Phalcon\Mvc\View;
class ProdutoController extends ControllerBase
{
	public function indexAction($produto,$id){
		$this->view->produto = Produtos::findById($id);
		$this->view->categoria = Categorias::findById($this->view->produto->categoria);
		$this->view->detalhe = 0;
		$this->view->posicao = 0;
	}

	public function previewAction(){
		$this->view->disableLevel(View::LEVEL_AFTER_TEMPLATE);
		$this->view->produto = Produtos::findById($this->request->getPost('id'));
		$this->view->categoria = Categorias::findById($this->view->produto->categoria);
		$this->view->detalhe = 0;
		$this->view->posicao = 0;
	}


	public function variacaoAction($produto,$id,$detalhe,$posicao){
		$this->view->produto = Produtos::findById($id);
		$this->view->categoria = Categorias::findById($this->view->produto->categoria);
		$this->view->detalhe = $detalhe;
		$this->view->posicao = $posicao;
	}

	public function avaliacaoAction(){
		$this->view->disable();
		if($this->request->isPost()){
			if($this->request->isAjax()){
				$avaliacao = new Avaliacoes();
				$avaliacao->data = date('Y-m-d H:i:s');
				if($avaliacao->save($this->request->getPost())){
					$this->response->setContent(json_encode(array('status' => true,'mensagem' => 'Obrigado pelo feedback, sua avaliação passará por uma análise assim que concluida deixaremos-a visivel para outros usuário.')));
				}else{
					$this->response->setContent(json_encode(array('status' => false,'mensagem' => 'Houve um erro, tente novamente mais tarde')));
				}
		        return $this->response;
			}
		}
	}

	public function searchAction(){
		$base = new BaseHelper;
        if($this->request->isPost()) {
            if(isset($_POST['q'])){
        	  	$this->view->disable();
            	$arr = array();
	            $param =  $this->request->getPost('q');
	            $produtos = Produtos::find(array('conditions' => array('nome' =>  new \MongoRegex("/$param/i")))); 
	            foreach ($produtos  as $key => $value) {
	                $arr[$key]['id'] =  (string) $value->_id;
	                $arr[$key]['name'] =  $value->nome;
	                $arr[$key]['imagem'] = $this->ecommerce_options->url_base.Imagens::findFirst($value->imagens[0])->url;
	            	$arr[$key]['url'] = $base->generateUrl($value->nome,$value->_id,'produto');
	            }
	            $this->response->setHeader("Content-Type", "application/json"); 
	            return $this->response->setContent(json_encode($arr));
        	}else{
	           	$this->view->indice = 0;
				$this->view->pagina = 0;
				$this->view->filtros = array();
        		$this->view->search = true;
        	}
        }

	}

}
