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
		'link_class' => 'btn btn-primary',
		'link_text' => 'Mais Detalhes',
		'navigation_container' => 'div',
		'navigation_class' =>'',
		'navigation_id' => '',
		'navigation_wrapper' => '',
		'posicao' => 1,
		'categoria' => '',
		'background' => false
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
		foreach ($banner as $key => $value) {
			$arr = array();
			for ($i=0; $i < count(unserialize($value->imagens)) ; $i++) { 
				$imagem = unserialize($value->imagens);
				$img = Imagens::findFirst("id = ".$imagem[$i])->toArray();
				$arr[] = $img;
			};
			if($this->options['background'] && count($arr) > 1){
				$img = "<img src='".$this->url_base.$arr[1]['url']."' class='img-responsive'/>";
			}else if(!$this->options['background']){
				$img = "<img src='".$this->url_base.$arr[0]['url']."' class='img-responsive'/>";
			}else{
				$img = '';
			}
			$replaces = array(
				$array['slide_item_id'],
				$array['slide_item_class'],
				$img,
				($array['caption'] ? $this->setCaption($value,$key) : '')
			);
			$itens .= parent::replaceWraper(4,
				$replaces,
				str_replace('BACKGROUND', 'style="background-image:url('.$this->url_base.$arr[0]['url'].');"', $array['slide_item_wrap'])
			);
			
		}
		return $itens;	
	}

	public function setCaption($dados,$chave){
		$html = '';
		foreach ($this->options['caption_options'] as $value) {
			$html .= $this->getCaption($dados,strtolower($value),0);
		}
		return $html;
	}

	public function getCaption($dados,$param,$chave){
		$item = '';
		if($param == 'title'){
			if($this->options['posicao'] == '1'){
				if($dados->descricao != ''){
					$item = $dados->nome;
				}else{
					$item = '';
				}
			}else{
				$item = $dados->nome;
			}
		}else if($param == 'description'){
			$item = nl2br($dados->descricao);
		}else if($param == 'link'){
			if($dados->link != ''){
				$item = "<a href='$dados->link' class='{$this->options['link_class']}'>{$this->options['link_text']}</a>";
			}
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