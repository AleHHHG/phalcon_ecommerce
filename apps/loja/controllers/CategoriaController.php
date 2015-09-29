<?php

namespace Ecommerce\Loja\Controllers;
use Phalcon\Mvc\Controller;
use Ecommerce\Admin\Models\Categorias;
use Phalcon\Mvc\View;
class CategoriaController extends ControllerBase
{
	public function indexAction($nome,$id){
		$this->session->remove('filtros');
		$categoria = Categorias::findById($id);
		if(!empty($categoria->subcategorias)){
			$array =  Categorias::getChildrensIds($categoria);
			$array[] = $categoria->_id;
			$this->view->indice = $array;
		}else{
			$this->view->indice = $id;
		}
		$this->view->id = $id;
		$this->view->pagina = 0;
		$this->view->filtros = array();
		$this->view->nome = $categoria->nome;
	}

	public function filtroAction($id){
		if($this->request->isPost()){
			$categoria = Categorias::findById($id);
			if(!empty($categoria->subcategorias)){
				$array =  Categorias::getChildrensIds($categoria);
				$array[] = $categoria->_id;
				$this->view->indice = $array;
			}else{
				$this->view->indice = $id;
			}
			$this->view->id = $id;
			if($this->request->getPost('filtros')){
				$itens = array_values(array_unique(array_column($this->request->getPost('filtros'),'tipo')));
				$filtros = array();
				foreach ($itens as $value) {
					foreach ($this->request->getPost('filtros') as $key => $filtro) {
						if($value == $filtro['tipo']){
							$filtros[$value][] =  $filtro['valor'];
						}
					}
				}
				$this->view->filtros = $filtros;
			}else{
				$this->view->filtros = array();	
			}
			$this->view->pagina = 0;
			$this->session->set('filtros',$this->view->filtros);
			$this->view->disableLevel(View::LEVEL_AFTER_TEMPLATE);
		}
	} 

	public function paginacaoAction($id,$pagina){
		$categoria = Categorias::findById($id);
		if(!empty($categoria->subcategorias)){
			$array =  Categorias::getChildrensIds($categoria);
			$array[] = $categoria->_id;
			$this->view->indice = $array;
		}else{
			$this->view->indice = $id;
		}
		$this->view->id = $id;
		$this->view->pagina = $pagina;
		$this->view->filtros = $this->session->get('filtros');
		$this->view->disableLevel(View::LEVEL_AFTER_TEMPLATE);
	}	
}
