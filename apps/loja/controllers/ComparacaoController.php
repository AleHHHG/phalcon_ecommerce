<?php
namespace Ecommerce\Loja\Controllers;
use Phalcon\Mvc\Controller;
use Ecommerce\Admin\Models\Produtos;
class ComparacaoController extends ControllerBase
{	

	public function indexAction(){
		$array = array();
		for ($i=0; $i < count($this->session->get('comparacao')); $i++) { 
			$array[] = Produtos::findById($this->session->get('comparacao')[$i])->toArray();
		}
		$chaves = array();
		foreach ($array[0] as $key => $value) {
			$chaves[] = $key; 
		}
		$this->view->produtos = $array;
		$this->view->chaves = $chaves;
	}

	public function createAction(){
		if($this->request->isPost()){
			$array = $this->insert($this->request->getPost());
		    if ($this->request->isAjax()){
		        $this->response->setContent(json_encode(array('status' => true,'mensagem' => 'Produto adicionado com sucesso','total' => count($this->session->get('comparacao')) )));
        		$this->view->disable();
		        return $this->response;
		    }
		}
	}

	public function insert($array){
		if($this->session->has('comparacao')){
			$comparacao = $this->session->get('comparacao');
			if(!in_array($array['produto_id'],$comparacao)){
				$comparacao[] =  $array['produto_id'];
				$this->session->set('comparacao',$comparacao);
			}
		}else{
			$this->session->set('comparacao',array($array['produto_id']));
		}
	}

	public function deleteAction($id){
		$comparacao = $this->session->get('comparacao');
		$key = array_search($id,$comparacao);
		unset($comparacao[$key]);
		$this->session->set('comparacao',array_values($comparacao));
		$this->dispatcher->forward(array(
            "action" => "index"
        ));
	}
}