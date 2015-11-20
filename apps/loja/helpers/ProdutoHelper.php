<?php
namespace Ecommerce\Loja\Helpers;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Avaliacoes;
use Ecommerce\Admin\Models\Imagens;
class ProdutoHelper extends BaseHelper {
	const QUICK_VIEW = '<a href="javascript:;"  data-produto="%1Ss" class="quick-view %2Ss">%3Ss</a>';
	const WISH_LIST = '<a href="javascript:;"  data-produto="%1Ss" class="addToWishList %2Ss">%3Ss</a>';
	const COMPARE = '<a href="javascript:;"  data-produto="%1Ss" class="addToCompare %2Ss">%3Ss</a>';
	public $options = array(
		'quantidade_itens' => 4,
		'container'       => 'div',
		'container_class' => '',
		'container_id'    => '',
		'item_wrap' => '<li class="%1Ss">%2Ss<li>',
		'item_class' => '',
		'thumbnail_wrap' =>'<div class="%1Ss">%2Ss</div>',
		'thumbnail_class' => '',
		'info_wrap' => '<div class="%1Ss">%2Ss</div>',
		'info_class' => '',
		'info_titulo_wrap' => '<h4 class="%1Ss"><a href="%2Ss">%3Ss</a></h4>',
		'info_titulo_class' => '',
		'info_preco_wrap' => '<span class="%1Ss">%2Ss</span>',
		'info_preco_class' => '',
		'desconto_container' => 'span',
		'desconto_class' =>'',
		'overlay' => true,
		'overlay_wrap' => '<div class="%1Ss">%2Ss</div>',
		'overlay_position' => 'THUMBNAIL_CONTAINER',
		'overlay_class' => '',
		'overlay_options' => array(
			'QUICK_VIEW' => array('text' => '<i class="fa fa-eye"></i>','class' =>'','content' => '','content_class' => ''),
			'WISH_LIST' => array('text' => '<i class="fa fa-heart-o"></i>','class' =>'','content' => '','content_class' => ''),
			'COMPARE' => array('text' => '<i class="fa fa-signal"></i>','class' =>'','content' => '','content_class' => ''),
		),
		'destaque' => 0,
		'lancamento' => 0,
		'categoria' => '',
		'opcoes' => array('PRECO','AVALIACOES','CORES'),
		'filtros' => array(),//Array associativo
		'pagina' => 0,
		'produto_container' => true,
		'search' => false,
		
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
		$html .= "<{$array['container']} id='{$array['container_id']}' class='{$array['container_class']}'>";
		foreach ($produtos as $key => $value) { 
			$item = $this->setThumbnail($array,$value);
			$item .= $this->setInfo($array,$value);
			$html .= parent::replaceWraper(2,array(
					'produto_item '.$this->options['item_class'],
					$item
				),
				$this->options['item_wrap']
			);
			if(($key+1) % $array['quantidade_itens'] == 0 ){
				$html .= '<br clear="all"/>';
			}
		}
		$html .= "</{$array['container']}>";
		$html .= ($this->options['produto_container']) ? '</div>' : '';
		if(!isset($array['relacionados'])){
			$html .= $this->getPagination($array['categoria'],$array['pagina']);
		}
		return $html;
	}

	public function setThumbnail($array,$obj){
		$html = '<a href="'.parent::generateUrl($obj->nome,$obj->_id,'produto').'">';
		$html .= $this->getThumbnail($obj);
		$html .= '</a>';
		if($array['overlay_position'] == 'THUMBNAIL_CONTAINER' && $array['overlay']){
			$html .= $this->setOverlay($array,$obj);
		}
		return  parent::replaceWraper(2,array(
				$this->options['thumbnail_class'],
				$html
			),
			$this->options['thumbnail_wrap']
		);
	}

	protected function getThumbnail($obj){
		if(!empty($obj->imagens)){
			$imagem = Imagens::findFirst($obj->imagens[0])->url;
		}else{
			$imagem = 'img/no-image.jpg';
		}
		if($this->ecommerce_options->produto_detalhes == '1'){
			$index =  parent::arrayMultiSearch($this->detalhes,'label','cor');
			if(!is_null($index)){
				if(isset($obj->detalhes[0]['cor'])){
					$cor = $obj->detalhes[0]['cor'];
					if(isset($obj->imagem_detalhes) && array_key_exists($cor,$obj->imagem_detalhes)){
						$imagem = Imagens::findFirst($obj->imagem_detalhes[$cor][0])->url;
					}
				}
			}
		}
		$size = explode('x', $this->ecommerce_options->thumbnail_size);
		$src = "?src={$this->url_base}public/$imagem&q=90&w={$size[0]}&h={$size[1]}&zc=2";
		return "<img src='{$this->url_base}public/timthumb$src' alt='{$obj->nome}' class='img-responsive'>";
	}

	public function setInfo($array,$obj){
		$html = parent::replaceWraper(3,array(
				$array['info_titulo_class'],
				parent::generateUrl($obj->nome,$obj->_id,'produto'),
				$obj->nome
			),
			$array['info_titulo_wrap']
		);
		foreach ($array['opcoes'] as $value) {
			if($value == 'PRECO'){
				if($this->ecommerce_options->produto_detalhes =='1'){
					$preco_total = $obj->detalhes[0]['valor'];
					if($obj->detalhes[0]['desconto']){
						$desconto = $obj->detalhes[0]['desconto'];
						$preco = 'R$ '.number_format($preco_total-$desconto,2,',','.');
						$preco .= '<'.$this->options['desconto_container'].' class="'.$this->options['desconto_class'].'"> R$ '.number_format($preco_total,2,',','.').'</'.$this->options['desconto_container'].'/>';
					}else{
						$preco = 'R$ '.number_format($preco_total,2,',','.');
					}
				}else{
					$preco_total = $obj->valor;
					if($obj->desconto){
						$desconto = $obj->desconto;
						$preco = 'R$ '.number_format($preco_total-$desconto,2,',','.');
						$preco .= '<'.$this->options['desconto_container'].' class="'.$this->options['desconto_class'].'"> R$ '.number_format($preco_total,2,',','.').'</'.$this->options['desconto_container'].'/>';
					}else{
						$preco = 'R$ '.number_format($preco_total,2,',','.');
					}
				}
				$html .= parent::replaceWraper(3,array(
							$array['info_preco_class'],
							$preco
						),
						$array['info_preco_wrap']
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
		return  parent::replaceWraper(2,array(
				$this->options['info_class'],
				$html
			),
			$this->options['info_wrap']
		);
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
		$html = '';
		foreach ($array['overlay_options'] as $key => $value) {
			if($value['content'] != ''){
				$content_class = (isset($value['content_class'])) ? $value['content_class'] : '';
				$conteudo =  '<'.$value['content'].' class="'.$content_class.'">'.constant('self::'.$key).'</'.$value['content'].'>';
			}else{
				$conteudo = constant('self::'.$key);
			}
			$overlay = parent::replaceWraper(3,array(
			 			$obj->_id,
			 			$value['class'],
			 			$value['text']
					),
					$conteudo
				);
			$html .= $overlay;
		}
		return parent::replaceWraper(2,array(
				$this->options['overlay_class'],
				$html
			),
			$this->options['overlay_wrap']
		);
	}

	protected function getData($array){
		$arr = array();
		if(isset($array['relacionados'])){
			if(!empty($array['relacionados'])){
				$ids = array();
				foreach ($array['relacionados'] as $value) {
					$ids[] = new \MongoId($value);
				}
				$arr['conditions'] = array('_id' => array('$in' => $ids));
			}else{
				$arr['conditions'] = array('categoria' => (string) $array['categoria'],
					'_id' => array('$ne' => $this->options['produto']->_id
				));			
			}
		}else if($array['search']){
			$param = $_POST['search'];
			$arr['conditions'] = array('nome' => new \MongoRegex("/$param/i"));
		}else{
			if($array['destaque']){
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
		}
		if($array['destaque']){
			$arr['limit'] = $this->ecommerce_options->produtos_destaque;
		}else{
			$arr['limit'] = $this->ecommerce_options->produtos_por_pagina;
		}
		$arr['conditions']['ativo'] = '1';
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
			$html = '<br clear="all"/><br clear="all"/><div id="pagination">';
			$html .= "<a href='{$this->url_base}categoria/paginacao/$categoria/$pagina' class='next'></a>";
			$html .= '</div>';
			return $html;
		}
	}

}