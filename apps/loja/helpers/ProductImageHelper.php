<?php
namespace Ecommerce\Loja\Helpers;
class ProductImageHelper extends SingleHelper {

	protected $layout;

	function __construct($layout){
		parent::__construct();
		$this->layout = $layout;
	}

	protected function getProductImages(){
		$html = "<div class='{$this->layout['size']}'>";
		$html .= "<{$this->layout['container']}  class='{$this->layout['container_class']}'>";
		$item = '';
		$produto_imagens = $this->setProdutoImagens();
		if($this->layout['navigation']){
			$navigation = $this->setNavigation($produto_imagens);
		}
		if($this->layout['navigation_position'] == 'AFTER_ITEM'){
			$html .= $navigation;
		}
		$after = ($this->layout['navigation_position'] == 'AFTER_ON_ITEM') ? $navigation : '';
		$before = ($this->layout['navigation_position'] == 'BEFORE_ON_ITEM') ? $navigation : '';
		if($this->layout['unique_item']){
			$item .= parent::replaceWraper(2,
					array(
						($this->layout['identificador']) ? $this->layout['item_class'].$int : $this->layout['item_class'],
						$this->setImagem($produto_imagens[0],'item',$after,$before)
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
		$html .= "</{$this->layout['container']}>";
		$html .= "</div>";
		return $html;
	}

	protected function setImagem($img,$param,$after,$before){
		$imagem = ($param == 'item') ? $after : '';
		$attr = '';
		foreach ($this->layout[$param.'_imagem_attr'] as $key => $value) {
			$attr .= $key.'='.$value.' ';
		}
		$imagem .= parent::replaceWraper(2,array(
			"{$this->url_base}files/produtos/$img",
			$attr
			),$this->layout[$param.'_imagem_wrap']);
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
					($this->layout['identificador']) ? $this->layout['navigation_item_id'].$int : $this->layout['navigation_item_id'],
					($this->layout['identificador']) ? $this->layout['navigation_item_class'].$int : $this->layout['navigation_item_class'],
					$this->setImagem($value,'navigation','','')
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
