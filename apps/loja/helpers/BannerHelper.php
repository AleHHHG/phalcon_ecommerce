<?php
namespace Ecommerce\Loja\Helpers;
use Ecommerce\Admin\Models\Banners;
use Ecommerce\Admin\Models\Imagens;
class BannerHelper extends BaseHelper{
	
	public $options = array(
		'container'       => 'div',
		'container_class' => '',
		'container_id'    => '',
		'slide_wrap' => '<ul id="%1Ss" class="%2Ss">%3Ss</ul>',
		'slide_class' =>'',
		'slide_id' => '',
		'slide_item_wrap' => '<li id="%1Ss" class="%2Ss">%3Ss %4Ss</li>',
		'slide_item_class' => '',
		'slide_item_id' => '',
		'caption' => true,
		'caption_options' => array('TITLE','DESCRIPTION','LINK','PRODUTO'),
		'title_wrap' => '<div %1Ss>%2Ss</div>',
		'title_options' => array(),
		'description_wrap' => '<div %1Ss>%2Ss</div>',
		'description_options' => array(),
		'produto_wrap' => '<div %1Ss>%2Ss</div>',
		'produto_options' => array(),
		'link_wrap' => '<div %1Ss>%2Ss</div>',
		'link_options' => array(),
		'navigation_container' => 'div',
		'navigation_class' =>'',
		'navigation_id' => '',
		'navigation_wrapper' => '',
		'posicao' => 1,
		'categoria' => '',
	);

	public  function getHelper($options = array()){
		$this->options = $options + $this->options;
		$string = $this->setHelper($this->options);
		return $string;
	}


	public function setHelper($array){
		$html = '';
		$html .= "<{$array['container']} id='{$array['container_id']}' class='{$array['container_class']}'>";
		$replaces = array($array['slide_id'],$array['slide_class'],$this->setData($array));
		$html .= parent::replaceWraper(3,$replaces,$array['slide_wrap']);
		$html .= "</{$array['container']}>";
		return $html;
	}

	public function setData($array){
		$itens = '';
		if($array['categoria'] == ''){
			$criteria = array("posicao_id = {$array['posicao']} AND categoria_id = '0'");
		}else{
			$criteria = array("posicao_id = {$array['posicao']} AND categoria_id = '{$array['categoria']}'");
		}
		$criteria['order'] = 'ordem asc';
		$banner = Banners::find($criteria);
		foreach ($banner as $key => $value) {;
			$imagem = Imagens::findFirst("id in (".implode(',', unserialize($value->imagens)).")")->url;
			$replaces = array(
				$array['slide_item_id'],
				$array['slide_item_class'],
				"<img src='".$this->url_base.$imagem."' class='img-responsive'/>",
				($array['caption'] ? $this->setCaption($value,$key) : '')
			);
			$itens .= parent::replaceWraper(4,
				$replaces,
				$array['slide_item_wrap']
			);
			
		}
		return $itens;	
	}

	public function setCaption($dados,$chave){
		$html = '';
		foreach ($this->options['caption_options'] as $value) {
			$html .= $this->getCaption($dados,strtolower($value),$chave);
		}
		return $html;
	}

	public function getCaption($dados,$param,$chave){
		$item = '';
		if($param == 'title'){
			if($dados->descricao != ''){
				$item = $dados->nome;
			}
		}else if($param == 'description'){
			$item = nl2br($dados->descricao);
		}else if($param == 'link'){
			$item = "<a href='$dados->link'>Mais Detalhes</a>";
		}else{
			$item = '';
		}
		$opcoes = '';
		if(isset($this->options[$param.'_options'][$chave])){
			$options = $this->options[$param.'_options'][$chave];
		}else{
			$options = $this->options[$param.'_options'];
		}
		foreach ($options as $key => $value) {
			$opcoes .= "$key='$value' ";
		}
		return parent::replaceWraper(2,
			array($opcoes,$item),
			$this->options[$param.'_wrap']
		);
}
}