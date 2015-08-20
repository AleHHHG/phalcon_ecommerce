<?php
namespace Ecommerce\Loja\Helpers;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Avaliacoes;
class ProdutoHelper extends BaseHelper {
	const QUICK_VIEW = '<a href="javascript:;" class="quick-view" data-produto="%1Ss"><i class="fa fa-eye"></i></a>';
	const WISH_LIST = '<a href="javascript:;" class="addToWishList" data-produto="%1Ss"><i class="fa fa-heart-o"></i></a>';
	const COMPARE = '<a href="javascript:;" class="addToCompare" data-produto="%1Ss"><i class="fa fa-signal"></i></a>';
	public $options = array(
		'quantidade_itens' => 4,
		'container'       => 'div',
		'container_class' => '',
		'container_id'    => '',
		'produto_thumbail_container' => 'div',
		'produto_thumbail_class' => '',
		'produto_thumbail_id' => '',
		'produto_info_container' => 'div',
		'produto_info_class' => '',
		'produto_info_id' => '',
		'produto_info_titulo' => '<h4 class="%1Ss"><a href="%2Ss">%3Ss</a></h4>',
		'produto_info_titulo_class' => '',
		'produto_info_preco' => '<span class="%1Ss">R$ %2Ss</span>',
		'produto_info_preco_class' => '',
		'overlay' => true,
		'overlay_container' => 'div',
		'overlay_position' => 'THUMBNAIL_CONTAINER',
		'overlay_class' => '',
		'overlay_options' => array('QUICK_VIEW','WISH_LIST','COMPARE'),
		'destaque' => 0,
		'lancamento' => 0,
		'categoria' => '',
		'opcoes' => array('PRECO','AVALIACOES','CORES'),
		'filtros' => array(),//Array associativo
		'pagina' => 0,
		'produto_container' => true,
		
	);
	protected $detalhes;
	public function __construct(){
		parent::__construct();
		$this->detalhes = unserialize($this->ecommerce_options->produto_detalhe_options);
	}

	public  function getHelper($options = array()){
		$this->options = $options + $this->options; 
		$string = $this->setHelper($this->options);
		return $string;
	}


	public function setHelper($array){
		$produtos = $this->getData($array);
		$html = '';
		$html .= ($this->options['produto_container']) ? '<div id="produto_container">' : '';
		foreach ($produtos as $key => $value) { 
			$html .= "<{$array['container']} id='{$array['container_id']}' class='{$array['container_class']} produto_item'>";
			$html .= $this->setThumbnail($array,$value);
			$html .= $this->setInfo($array,$value);
			$html .= "</{$array['container']}>";
			if(($key+1) % $array['quantidade_itens'] == 0 ){
				$html .= '<br clear="all"/>';
			}
		}
		$html .= ($this->options['produto_container']) ? '</div>' : '';
		$html .= $this->getPagination($array['categoria'],$array['pagina']);
		return $html;
	}

	public function setThumbnail($array,$obj){
		$html = "<{$array['produto_thumbail_container']} id='{$array['produto_thumbail_id']}' class='{$array['produto_thumbail_class']}'>";
		if($this->ecommerce_options->produto_detalhes == '1'){
			$index =  parent::arrayMultiSearch($this->detalhes,'label','cor');
			if(!is_null($index)){
				$cor = $obj->detalhes[0]['cor'];
				if(isset($obj->imagem_detalhes) && array_key_exists($cor,$obj->imagem_detalhes)){
					$html .= "<img src='{$this->url_base}files/produtos/{$obj->imagem_detalhes[$cor][0]}' alt='{$obj->nome}' class='img-responsive'>";
				}else{
					$html .= "<img src='{$this->url_base}files/produtos/{$obj->imagens[0]}' alt='{$obj->nome}' class='img-responsive'>";
				}
			}else{
				$html .= "<img src='{$this->url_base}files/produtos/{$obj->imagens[0]}' alt='{$obj->nome}' class='img-responsive'>";
			}
		}else{
			if(!empty($obj->imagens)){
				$html .= "<img src='{$this->url_base}files/produtos/{$obj->imagens[0]}' alt='{$obj->nome}' class='img-responsive'>";
			}else{
				$html .= "<img src='http://www.clker.com/cliparts/i/l/9/W/l/m/camera-icon-hi.png' />";
			}
		}
		if($array['overlay_position'] == 'THUMBNAIL_CONTAINER' && $array['overlay']){
			$html .= $this->setOverlay($array,$obj);
		}
		$html .= "</{$array['produto_thumbail_container']}>";
		return $html;
	}

	public function setInfo($array,$obj){
		$opcoes = $this->getDI()->getShared('ecommerce_options');
		$html = "<{$array['produto_info_container']} id='{$array['produto_info_id']}' class='{$array['produto_info_class']}'>";
		$html .= parent::replaceWraper(3,array(
				$array['produto_info_titulo_class'],
				parent::generateUrl($obj->nome,$obj->_id,'produto'),
				$obj->nome
			),
			$array['produto_info_titulo']
		);
		foreach ($array['opcoes'] as $value) {
			if($value == 'PRECO'){
				$html .= parent::replaceWraper(2,array(
							$array['produto_info_preco_class'],
							($opcoes->produto_detalhes =='1') ? number_format($obj->detalhes[0]['valor'],2,',','.') : number_format($obj->valor,2,',','.')
						),
						$array['produto_info_preco']
					);
			}else if($value == 'CORES'){
				$html .= $this->getCores($obj);
			}else if($value == 'AVALIACOES'){
				$html .= $this->getAvaliacoes($obj);
			}
		}
		if($array['overlay_position'] == 'INFO_CONTAINER' && $array['overlay']){
			$html .= $this->setOverlay($array,$obj);
		}
		$html .= "</{$array['produto_info_container']}>";
		return $html;
	}

	protected function getCores($obj){
		$html = '';
		$index =  parent::arrayMultiSearch($this->detalhes,'label','cor');
		if(!is_null($index)){
			$cores = array_values(array_unique(array_column($obj->detalhes,'cor')));
			if(count($cores) > 1){
				foreach ($cores as $key => $value) {
					$ref = $this->detalhes[$index]['referencia'];
					$referencia = $ref::findFirst("nome = '$value'")->toArray();
					$url = parent::generateUrl($obj->nome,$obj->_id,'produto_variacao');
					$url = $url.'/'.$referencia['nome'].'/'.$key;
					$html .= "<a href='$url' class='sideColor color-produto-detalhe variacao' style='background-color:{$referencia['hexa']}'></a>";
				}
				$html .= '<br clear="all"/>';
			}
		}
		return $html;
	}

	protected function getAvaliacoes($obj){
		$html = '';
		$condicoes = array(
			"produto_id = '{$obj->_id}' and avaliacao_tipo_id = 2 and aprovado = 1",
			'column' => 'nota',
		);
		$total = Avaliacoes::count($condicoes);
		$avaliacao = Avaliacoes::getStars(Avaliacoes::average($condicoes));
		if($avaliacao != ''){
			$str = ($total <= 1) ?  'Avaliação' : 'Avaliações';
			$html .=  $avaliacao.' ( '.$total.' '.$str.' )';
			$html .= '<br clear="all"/>';
		}
		return $html;
	}

	public function setOverlay($array,$obj){
		$html = "<{$array['overlay_container']} class='{$array['overlay_class']}'>";
		foreach ($array['overlay_options'] as $key => $value) {
			$overlay = parent::replaceWraper(1,array(
			 			$obj->_id
					),
					constant('self::'.$value)
				);
			$html .= $overlay;
		}
		$html .= "</{$array['overlay_container']}>";
		return $html;
	}

	protected function getData($array){
		$arr = array();
		if($array['destaque' ]){
			$arr['conditions'] = array('destaque' => '1');
		}else if($array['lancamento']){
			$arr['conditions'] = array('destaque' => '0');
		}else if($array['categoria'] != ''){
			if(is_array($array['categoria'])){
				$ids = array();
				foreach ($array['categoria'] as $value) {
					$ids[] = (string)$value;
				}
				$arr['conditions'] = array('categoria' => array('$in' => $ids));
			}else{
				$arr['conditions'] = array('categoria' => $array['categoria']);
			}
		}
		if(!empty($array['filtros'])){
			$filtros = array();
			foreach ($array['filtros'] as $key => $value) {
				if($key != 'valor'){
					$filtros['$elemMatch']["$key"] = array(
						'$in' => $value,
					);
				}else{
					$valores = explode(';', $value[0]);
					$filtros['$elemMatch']["$key"] = array(
						'$gte' => floatval($valores[0]),
						'$lte' => floatval($valores[1]),
					);
				}
			}
			$arr['conditions']['detalhes'] = $filtros;
		}
		$arr['conditions']['ativo'] = '1';
		$arr['limit'] = $this->ecommerce_options->produtos_por_pagina;
		if($array['pagina'] != 0){
			$arr['skip'] = intval($this->ecommerce_options->produtos_por_pagina) * $array['pagina'];
		}
		$arr['sort'] = array('created_at' => -1);
		return Produtos::find($arr);
	}

	protected function getPagination($categoria,$pagina){
		if($this->ecommerce_options->paginacao_tipo == 'google'){
			$pagina = intval($pagina)+1;
			if(is_array($categoria)){
				$categoria = $categoria['current'];
			}
			$html = '<br clear="all"/><div id="pagination">';
			$html .= "<a href='{$this->url_base}categoria/paginacao/$categoria/$pagina' class='next'></a>";
			$html .= '</div>';
			return $html;
		}
	}

}