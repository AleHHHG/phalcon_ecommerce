<?php

namespace Ecommerce\Loja\Controllers;
use Phalcon\Mvc\Controller;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Avaliacoes;
class ProdutoController extends ControllerBase
{
	public function indexAction($produto,$id){
		$this->view->produto = Produtos::findById($id);
		$this->view->detalhe = 0;
		$this->view->posicao = 0;
	}

	public function variacaoAction($produto,$id,$detalhe,$posicao){
		$this->view->produto = Produtos::findById($id);
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
}
