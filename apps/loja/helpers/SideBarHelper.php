<?php
namespace Ecommerce\Loja\Helpers;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Categorias;
class SideBarHelper extends BaseHelper {

	public $options = array(
		'tipos' => array(),
	);

	public $layouts = array(
		'BASE_LAYOUT' => array(
			'container' => 'div',
			'container_class' => '',
			'container_id' => '',
			'wrap' => '<ul class="%1Ss">%2Ss</ul>',
			'base_class' => '',
			'item_wrap' => '<li class="%1Ss"><a class="%2Ss" href="%3Ss" %4Ss >%5Ss</a> %6Ss</li>',
			'link_class' =>	'',
			'item_class' => '',
			'title' => true,
			'title_class' => '',
			'title_label' => '',
			'title_wrap' => '<h5 class="%1Ss">%2Ss</h5>',
		),

		'PRICE_SLIDER_LAYOUT' => array(
			'container' => 'div',
			'container_class' => '',
			'container_id' => '',
			'wrap' => ' <div id="%1Ss" %2Ss></div>',
			'id' => 'slider-container',
			'item_wrap' => '<p id="amount"></p>',
			'title' => true,
			'title_class' => '',
			'title_label' => '',
			'title_wrap' => '<h5 class="%1Ss">%2Ss</h5>',
		),

		'SEARCH_LAYOUT' => array(
			'container' => 'div',
			'container_class' => '',
			'container_id' => '',
			'wrap' => '<form class="%1Ss" action="%2Ss" method="post">%3Ss %4Ss</form>',
			'form_class' => '',
			'input_wrap' =>	'<input type="text" name="search">',
			'button_wrap' => '<button type="submit">Buscar</button>',
			'title' => false,
			'title_class' => '',
			'title_label' => 'Buscar',
			'title_wrap' => '<h5 class="%1Ss">%2Ss</h5>',
		),
	);

	public  function getHelper($options = array()){
		$options = $options + $this->options;
		$string = $this->setHelper($options);
		return $string;
	}


	public function setHelper($array){
		$html = '';
		if(!empty($array['tipos'])){
			foreach($array['tipos'] as $key => $value) {
				$layout = $value + $this->layouts[$value['layout']];
				$html .= $this->setWidget($layout,$key);	
			}
		}
		return $html;
	}

	protected function setWidget($layout,$tipo){
		if($tipo == 'PRODUTO_DETALHES'){
			$html = $this->setWidgtedDetalhes($layout);
		}else{
			$html = "<{$layout['container']} id='{$layout['container_id']}' class='{$layout['container_class']}'>";
			if($layout['title']){
				$html .= $this->setTitleLabel($layout);
			}
			//WIDGET TIPO PESQUISA
			if($tipo == 'SEARCH'){
				$replaces = array(
					$layout['form_class'],
					'search',
					$layout['input_wrap'],
					$layout['button_wrap']
				);
				$html .= parent::replaceWraper(4,$replaces,$layout['wrap']);
			
			//WIDGET TIPO CATEGORIAS
			}else if($tipo == 'CATEGORIAS'){
				$categorias =  $this->getCategorias($layout);
				$replaces = array(
					$layout['base_class'],
					$categorias,
				);
				$html .= parent::replaceWraper(2,$replaces,$layout['wrap']);
			
			//WIDGET PRICE SLIDER
			}else if($tipo == 'PRICE_SLIDER'){
				$html .= parent::replaceWraper(2,
					array(
						$layout['id'],
						"data-categoria='{$layout['categoria_id']}'"
					),$layout['wrap']);
				$html .= $layout['item_wrap'];
			}
			$html .= "</{$layout['container']}>";
		}
		return $html;
	}

	protected function setWidgtedDetalhes($layout){
		$html = '';
		if($this->ecommerce_options->produto_detalhes == 1){
			$detalhes = unserialize($this->ecommerce_options->produto_detalhe_options);
			$categoria = Categorias::findById($layout['categoria_id']);
			$ids = array();
			$subcategorias = Categorias::getChildrensIds($categoria);
			if(!empty($subcategorias)){
				foreach ($subcategorias as $value) {
					$ids[] = (string)$value;
				}
			}
			$ids[] = (string)$categoria->_id;
			$produtos = Produtos::find($this->getConditions($ids));
			foreach ($detalhes as $value) {
				$array = array();
				for ($i=0; $i < count($produtos) ; $i++) { 
					foreach ($produtos[$i]['detalhes'] as $key => $valor) {
						if(isset($valor[$value['label']])){
							$array[] = $valor[$value['label']];
						}
					}
				}
				$html .= $this->getWidgtedDetalhes($layout,array_unique($array),$value);
			}
		}
		return $html;
	}

	protected function getWidgtedDetalhes($layout,$array,$detalhe){
		if(!empty($array)){
			$html = "<{$layout['container']} id='{$layout['container_id']}' class='{$layout['container_class']}'>";
			if($layout['title']){
				$layout['title_label'] = strtoupper(parent::pluralize($detalhe['label']));
				$html .= $this->setTitleLabel($layout);
			}
			$item = '';
			foreach ($array as $key => $value){
				if($detalhe['label'] == 'cor'){
					$cor = $detalhe['referencia']::findFirst("nome = '$value' ");
					$resultado = "<div class='sideColor' style='background-color:$cor->hexa'></div> ".$value;
				}else{
					$resultado = $value;
				}
				$replaces = array(
					$layout['item_class'],
					'filtro-detalhe '.$layout['link_class'],
					'javascript:;',
					"data-categoria='".$layout['categoria_id']."' data-tipo='".$detalhe['label']."' data-valor='".$value."'",
					$resultado,
					'',

				);
				$item .= parent::replaceWraper(6,$replaces,$layout['item_wrap']);
			}
			$replaces = array(
						$layout['base_class'],
						$item,
					);
			$html .= parent::replaceWraper(2,$replaces,$layout['wrap']);
			$html .= "</{$layout['container']}>";
			return $html;
		}
	}

	protected function getConditions($ids){
		$arr['conditions'] = array('categoria' => array('$in' => $ids));
		$arr['conditions']['ativo'] = '1';
		$arr['fields']['detalhes'] = true;
		$arr['sort'] = array('created_at' => -1);
		return $arr;
	}


	protected function getCategorias($array){
		$categorias = Categorias::findById($array['categoria_id']);
		$dados = Categorias::getChildrens($categorias);
		$items = '';
		foreach ($dados->subcategorias as $key => $value) {
			$replaces = array(
				$array['item_class'],
				$array['link_class'],
				parent::generateUrl($value['nome'],$value['id'],'categoria'),
				'',
				$value['nome'],
				'',
			);
			$items .= parent::replaceWraper(6,$replaces,$array['item_wrap']);
		}
		return $items;
	}

	protected function setTitleLabel($layout){
		return parent::replaceWraper(2,array($layout['title_class'],$layout['title_label']),$layout['title_wrap']);
	}
}