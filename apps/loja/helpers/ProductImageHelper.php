<?php
namespace Ecommerce\Loja\Helpers;
use Ecommerce\Admin\Models\Imagens;
class ProductImageHelper extends SingleHelper {

	protected $layout;

	function __construct($layout){
		parent::__construct();
		$this->layout = $layout;
	}

	protected function getProductImages(){
		$html = "<div class='{$this->layout['size']}'>";
		$item = '';
		$produto_imagens = $this->setProdutoImagens();
		if($this->layout['navigation']){
			$navigation = $this->setNavigation($produto_imagens);
		}else{
			$navigation = '';
		}
		if($this->layout['navigation_position'] == 'AFTER_ITEM'){
			$html .= $navigation;
		}
		$after = ($this->layout['navigation_position'] == 'AFTER_ON_ITEM') ? $navigation : '';
		$before = ($this->layout['navigation_position'] == 'BEFORE_ON_ITEM') ? $navigation : '';
		if($this->layout['unique_item']){
			$item .= parent::replaceWraper(2,
					array(
						($this->layout['identificador']) ? $this->layout['item_class'] : $this->layout['item_class'],
						$this->setImagem((isset($produto_imagens[0])) ? $produto_imagens[0] : '0','item',$after,$before)
					),
					$this->layout['item_wrap']);
		}else{
			foreach ($produto_imagens as $key => $value){
				$int = $key+1;
				$item .= parent::replaceWraper(2,
					array(
						($this->layout['identificador']) ? $this->layout['item_class'].$int : $this->layout['item_class'],
						$this->setImagem($value,'item',$after,$before)
					),
					$this->layout['item_wrap']);
			}
		}
		if($this->layout['wrap'] != ''){
			$html .= parent::replaceWraper(2,
				array(
					$this->layout['wrap_class'],
					$item,
				),
				$this->layout['wrap']);
		}else{
			$html .= $item;
		}
		if($this->layout['navigation_position'] == 'BEFORE_ITEM'){
			$html .= $navigation;
		}
		$html .= "</div>";
		return $html;
	}

	protected function setImagem($img,$param,$after,$before,$identificador = 0){
		if($img == 0){
			$img = new \stdClass();
			$img->url = '/img/no-image.jpg';
		}else{
			$img = Imagens::findFirst($img);
		}
		$imagem = ($param == 'item') ? $after : '';
		$attr = '';
		foreach ($this->layout[$param.'_imagem_attr'] as $key => $value) {
			$attr .= $key.'='.$value.' ';
			if(isset($this->ecommerce_options->galeria) && $this->ecommerce_options->galeria != ''){
				$attr .= 'data-galeria="'.$this->ecommerce_options->galeria.'"';
			}
		}
		$img_url = $this->url_base.$img->url;
		$size = explode('x', $this->ecommerce_options->imagem_size);
		$src = "{$this->url_base}public/{$img->url}&q=90&w={$size[0]}&h={$size[1]}&zc=2";
		$img = "{$this->url_base}public/timthumb?src=$src'";
		if($this->layout['identificador']){
			$wrap = str_replace('_IDENTIFICADOR_', $identificador, $this->layout[$param.'_imagem_wrap']);
			$wrap = str_replace('_ZOOM_', $img_url, $wrap);
			$wrap = str_replace('_IMAGE_', $img, $wrap);
		}else{
			$wrap = $this->layout[$param.'_imagem_wrap'];
		}
		if($param == 'item'){
			$imagem .= parent::replaceWraper(3,array(
				$img,
				$attr,
				"data-zoom-image='{$img_url}'",
				),$wrap);
		}else{
			$imagem .= parent::replaceWraper(2,array(
				$img,
				$attr
				),$wrap);
		}
		$imagem .= ($param == 'item') ? $before : '';
		return $imagem;
	}

	protected function setNavigation($imagens){
		$html = "<{$this->layout['navigation_container']}  class='{$this->layout['navigation_class']}'>";
		$item = '';
		foreach ($imagens as $key => $value) {
			$int = $key+1;
			$item .= parent::replaceWraper(3,
				array(
					$this->layout['navigation_item_id'],
					$this->layout['navigation_item_class'],
					$this->setImagem($value,'navigation','','',$key)
				),
				$this->layout['navigation_item']);
		}
		$html .= parent::replaceWraper(2,
				array(
					$this->layout['navigation_wrap_class'],
					$item,
				),
				$this->layout['navigation_wrap']);
		$html .= "</{$this->layout['navigation_container']}>";
		return $html;
	}

	protected function setProdutoImagens(){
		$produto_imagens = $this->layout['produto']->imagens;
		if($this->ecommerce_options->produto_detalhes == '1'){
			$detalhes = unserialize($this->ecommerce_options->produto_detalhe_options);
			$index =  parent::arrayMultiSearch($detalhes,'label','cor');
			if(!is_null($index)){
				if($this->layout['detalhe'] == '0'){
					if(isset($this->layout['produto']->detalhes[0]['cor'])){
						$cor = $this->layout['produto']->detalhes[0]['cor'];
						if(isset($this->layout['produto']->imagem_detalhes) && array_key_exists($cor,$this->layout['produto']->imagem_detalhes)){
							$produto_imagens = $this->layout['produto']->imagem_detalhes[$cor];
						}
					}
				}else{
					$chave =  parent::arrayMultiSearch($this->layout['produto']->detalhes,$detalhes[0]['label'],$this->layout['detalhe']);
					$cor = $this->layout['produto']->detalhes[$chave]['cor'];
					if(isset($this->layout['produto']->imagem_detalhes) && array_key_exists($cor,$this->layout['produto']->imagem_detalhes)){
						$produto_imagens = $this->layout['produto']->imagem_detalhes[$cor];
					}
				}
			}
		}
		return $produto_imagens;
	}
}
