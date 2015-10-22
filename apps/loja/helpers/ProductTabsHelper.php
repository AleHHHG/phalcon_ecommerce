<?php
namespace Ecommerce\Loja\Helpers;
use Ecommerce\Admin\Models\Avaliacoes;
class ProductTabsHelper extends SingleHelper {	
	
	protected $layout;

	function __construct($layout){
		parent::__construct();
		$this->layout = $layout;
	}

	protected function getProductTabs(){
		$html = "<{$this->layout['container']}  class='{$this->layout['container_class']}'>";
		$html .= $this->setTabNav();
		$html .= "<{$this->layout['tab_container']}  class='{$this->layout['tab_class']}'>";
		$html .= $this->setTabItem();
		$html .= "</{$this->layout['tab_container']}>";
		$html .= "</{$this->layout['container']}>";
		return $html;
	}

	protected function setTabNav(){
		$item = '';
		foreach ($this->layout['tab_itens'] as $key => $value) {
			$item .= parent::replaceWraper(3,array(
					($key == 0) ? 'active '.$this->layout['nav_item_class']: $this->layout['nav_item_class'],
					'#'.$value,
					strtoupper($value)
				),
				$this->layout['nav_item_wrap']
			);
		}
		return parent::replaceWraper(2,array(
					$this->layout['nav_wrap_class'],
					$item,
				),
				$this->layout['nav_wrap']
			);
	}

	protected function setTabItem(){
		$html = '';
		foreach ($this->layout['tab_itens'] as $key => $value) {
			$active = ($key == 0) ? 'active' : '';
			$html .= "<{$this->layout['item_container']}  class='{$this->layout['item_class']} $active' id='$value'>";
			if($value == 'descrição'){
				$html .= $this->layout['produto']->descricao;
			}else if($value == 'avaliação'){
				$html .= $this->getAvaliacaoTab();
			}else if($value == 'detalhes'){
				$html .= $this->getDetalhes();
			}
			$html .= "</{$this->layout['item_container']}>";
		}
		return $html;		
	}

	private function getAvaliacaoTab(){
		$html = $this->getAvaliacoes((string)$this->layout['produto']->_id);
		$html .= $this->setAvaliacaoForm();
		return $html;
	}

	private function getAvaliacoes($produto){
		$html = '';
		$avaliacoes = Avaliacoes::find("produto_id = '$produto' and avaliacao_tipo_id = 2 and aprovado = 1");
		if(!empty($avaliacoes->toArray())){
			$html .= '<div class="reviews">';
			foreach ($avaliacoes as $key => $value) {
				$data = date('d/m/Y',strtotime($value->data));
				$stars = Avaliacoes::getStars($value->nota);
				$nome =($value->Usuario) ? $value->Usuario->nome : $value->nome;
				$html .= "<h5><strong>$nome</strong> $data - {$stars}</h5>
						<p>{$value->descricao}</p>
						<hr/>";
			}
			$html .= '</div>';
		}else{
			$html .= '<div class="alert alert-warning">Esse produto ainda não foi avaliado.</div><hr/>';
		}
		return $html;
	}

	private function setAvaliacaoForm(){
		if($this->session->get('logado')){
			//$input = "<input class='form-control' name='nome' value='".$this->session->get('nome')."' disabled />";
			$input = "<input type='hidden' name='usuario_id' value='".$this->session->get('id')."' />";
		}else{
			$input = '<label>Nome</label>';
			$input .= '<input class="form-control" name="nome"/>';
		}
	 	return "<form id='sendAvaliacao'>
		 	<h4>Deixe sua Avaliação</h4>
		 	<div class='form-group'>
		 		$input
		 	</div>
		 	<div class='form-group'>
		 		<label>Mensagem</label>
		 		<textarea class='form-control' rows=5 name='descricao'></textarea>
		 	</div>
		 	<div class='form-group'>
		 		<label>Nota do produto:&nbsp &nbsp<label>
		 		<div class='ratings'>
		            <i class='fa fa-star stars nota-avaliacao' data-nota='1'></i>
		            <i class='fa fa-star stars nota-avaliacao' data-nota='2'></i>
		            <i class='fa fa-star stars nota-avaliacao' data-nota='3'></i>
		            <i class='fa fa-star stars nota-avaliacao' data-nota='4'></i>
		            <i class='fa fa-star stars nota-avaliacao' data-nota='5'></i>
		        </div>
		 	</div>
		 	<input type='hidden' name='nota' id='avaliacao-nota' value='0' />
		 	<input type='hidden' name='produto_id' value='".$this->layout['produto']->_id."'/ >
		 	<input type='hidden' name='avaliacao_tipo_id' value='2'/ >
		 	<div class='form-group'>
		 		<button type='submit' class='btn btn-primary'>Enviar Avaliação</button>
		 	</div>
		 	<div class='alert alert-success' style='display:none'></div>
		 </form>";
	}

	private function getDetalhes(){
		$html = '<ul class="'.$this->layout['list'].'">';
	 	$detalhes = unserialize($this->ecommerce_options->produto_options);
        if(!empty($detalhes)){
	        foreach ($detalhes as $key => $value) {
	        	if(isset($this->layout['produto']->$value['label']) && $this->layout['produto']->$value['label'] != ''){
	        		$html .= '<li class="'.$this->layout['list_item'].'">'.ucwords($value['label']).': '.$this->layout['produto']->$value['label'].'</li>';	
	        	}
	        }
	    }
		$html .= '<li class="'.$this->layout['list_item'].'">Peso: '.$this->layout['produto']->peso.' KG </li>';
		$html .= '<li class="'.$this->layout['list_item'].'">Altura: '.$this->layout['produto']->altura.' CM</li>';
		$html .= '<li class="'.$this->layout['list_item'].'">Lagura: '.$this->layout['produto']->largura.' CM </li>';
		$html .= '<li class="'.$this->layout['list_item'].'">Comprimento: '.$this->layout['produto']->comprimento.' CM </li>';
		$html .= '</ul>';
		return $html;
	}
}