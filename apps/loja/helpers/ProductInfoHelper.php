<?php
namespace Ecommerce\Loja\Helpers;
use Ecommerce\Admin\Models\Avaliacoes;
class ProductInfoHelper extends SingleHelper {
	
	protected $layout;

	function __construct($layout){
		parent::__construct();
		$this->layout = $layout;
	}

	protected function getProductInfo(){
		$html = "<div class='{$this->layout['size']}'>";
		$html .= "<{$this->layout['container']}  class='{$this->layout['container_class']}'>";
		// Seta o nome do produto
		$html .= $this->setProductTitle();
		if($this->layout['avaliacao']){
			$html .= $this->setAvaliacao();
		}
		// Seta a preço do produto
		$html .= $this->setProductPrice($this->layout['produto']);

		// Seta o descricao do produto
		$html .= $this->setProductDescription($this->layout['produto']);

		$html .= $this->getDetalhes();

		$html .= $this->setAddCart();

		if($this->layout['social']){
			$html .= $this->setSocial();
		}

		$html .= "</{$this->layout['container']}>";
		$html .= "</div>";
		return $html;
	}

	protected function setProductTitle(){
		return parent::replaceWraper(2,array($this->layout['title_class'],$this->layout['produto']->nome),$this->layout['title_wrap']);
	}

	protected function setProductPrice($produto){
		if($this->ecommerce_options->produto_detalhes == '1'){
			if($this->layout['detalhe'] == '0'){
				$valor = 'R$ '.number_format($produto->detalhes[0]['valor'],2,',','.');
			}else{
				$detalhes = unserialize($this->ecommerce_options->produto_detalhe_options);
				$index =  parent::arrayMultiSearch($this->layout['produto']->detalhes,$detalhes[0]['label'],$this->layout['detalhe']);
				$valor = 'R$ '.number_format($produto->detalhes[$index]['valor'],2,',','.');
			}
		}else{
			$valor = 'R$ '.number_format($produto->valor,2,',','.');
		}
		return parent::replaceWraper(2,array(
				$this->layout['preco_class'],
				$valor
			),
			$this->layout['preco_wrap']
		);
	}

	protected function setProductDescription($produto){
		$html = "<{$this->layout['descricao_container']} class='{$this->layout['descricao_class']}'>";
		$string = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum imperdiet et orci quis commodo. Vivamus sit amet tortor sagittis, efficitur ante sit amet, viverra orci. Fusce condimentum sapien et augue pellentesque semper. Sed ac justo non mauris congue viverra. Nullam feugiat eros lectus, in hendrerit libero hendrerit at. Donec imperdiet quis neque ac pulvinar. Aenean velit mauris, lobortis ut venenatis non, vestibulum ac neque. ';
		//$html .= $produto->descricao;
		$html .= $string;
		$html .= "</{$this->layout['descricao_container']}>";
		return $html;
	}

	protected function setAvaliacao(){
		$produto = (string)$this->layout['produto']->_id;
		$stars = Avaliacoes::getStars(Avaliacoes::average(array(
				"produto_id = '$produto' and avaliacao_tipo_id = 2 and aprovado = 1",
				'column' => 'nota',
			))
		);
		return parent::replaceWraper(2,array($this->layout['avaliacao_class'],$stars),$this->layout['avaliacao_wrap']);
	}

	protected function getDetalhes(){
		$html = '<div class="col-md-4 no-padding-left"><h5><strong>Quantidade:</strong></h5><select name="quantidade" class="form-control quantidade" id="quantidade">';
		$html .= '<option value="0">Selecione a quantidade</option>';
		$estoque = (isset($this->layout['produto']->estoque)) ? $this->layout['produto']->estoque : $this->layout['produto']->detalhes[0]['estoque'];
		for ($i=1; $i <=  $estoque; $i++) { 
			$html .= "<option value='$i'>$i</option>";
		}
		$html .= '</select></div><br clear="all"/><br clear="all"/>';	
		$html .= "<input type='hidden' name='produto_id' id='produto_id' value='{$this->layout['produto']->_id}' />";
		if($this->ecommerce_options->produto_detalhes == '1'){
			$detalhes = unserialize($this->ecommerce_options->produto_detalhe_options);
			$array = array_values(array_unique(array_column($this->layout['produto']->detalhes,$detalhes[0]['label'])));
			if(!empty($array)){
				$itens = $this->groupDetalhes($detalhes[0],$array,$this->layout['produto']->detalhes);
				$html = $this->setDetalhes($itens,$detalhes,($this->layout['posicao'] == 0) ? 0 : $this->layout['posicao']);
			}
		}
		return $html;
	}

	private function groupDetalhes($detalhe,$item,$produto_detalhes){
		$array = array();
		for ($i=0; $i < count($item) ; $i++) { 
			$array['label'] = $detalhe['label'];
			foreach ($produto_detalhes as $key => $value) {
				if($item[$i] == $value[$detalhe['label']]){
					$array['detalhes'][$i]['itens'][] =  $value;
					$array['detalhes'][$i]['referencia'] = $detalhe['referencia']::findFirst("nome = '{$item[$i]}'")->toArray();
				}			
			}
		}
		return $array;
	}

	private function setDetalhes($itens,$detalhes,$posicao){
		$label = ucwords(parent::pluralize($itens['label']));
		$html = "<div class='col-md-12 no-padding-left'><h5><strong>$label </strong></h5>";
		foreach ($itens['detalhes'] as $key => $value) {
			$active = ($key == $posicao) ? 'color-active' : ''; 
			if($itens['label'] == 'cor' || $itens['label'] == 'cores'){
				$url = parent::generateUrl($this->layout['produto']->nome,$this->layout['produto']->_id,'produto_variacao');
				$url = $url.'/'.$value['referencia']['nome'].'/'.$key;
				$html .= "<a href='$url' class='sideColor $active color-produto-detalhe variacao' style='background-color:{$value['referencia']['hexa']}'></a> ";
			}else{
				$html .= "<a href='#' class='sideColor $active color-produto-detalhe'>{$value['referencia']['nome']}</a>";
			}
		}
		$html .= '</div><br clear="all"/><br clear="all"/> <br clear="all"/> ';
		if(isset($detalhes[1])){
			foreach ($itens['detalhes'][$posicao]['itens'] as $key => $value) {
				$array[$value[$detalhes[1]['label']]] = $value;
			}
			$html .= $this->generateOptions($array,$detalhes);
		}else{
			foreach ($itens['detalhes'][$posicao]['itens'] as $key => $value) {
				$array[$value[$detalhes[0]['label']]] = $value;
			}
			$array = array_values($array);
			$html .= "<input type='hidden' name='detalhe_id' id='detalhe_id' value='{$array[0]['detalhe_id']}' />";
		}
		$html .= $this->generateOptions($array,$detalhes,true);
		$html .= "<input type='hidden' name='produto_id' id='produto_id' value='{$this->layout['produto']->_id}' />";
		return $html;
	}

	private function generateOptions($array,$detalhes,$estoque =false){
		$html = '';
		if(!$estoque){
			if($this->layout['options']['label']){
				$label = ucwords(parent::pluralize($detalhes[1]['label']));
			}else{
				$label = '';
			}
			$html .= "<div class='".$this->layout['options']['container_size']." no-padding-left'><".$this->layout['options']['label_container'].">$label</".$this->layout['options']['label_container'].">";
			$html .= '<select name="detalhe" id="detalhe" class="form-control detalhe">';
			foreach ($array as $key => $value) {
				$html .= "<option value='$key' data-estoque='{$value['estoque']}' data-detalhe='{$value['detalhe_id']}'>$key</option>";
			}
			$html .= '</select></div>';
			$array = array_values($array);
			$html .= "<input type='hidden' name='detalhe_id' id='detalhe_id' value='{$array[0]['detalhe_id']}' />";
		}else{
			if($this->layout['options']['label']){
				$label = 'Quantidade';
			}else{
				$label = '';
			}
			$html .= "<div class='".$this->layout['options']['container_size']." no-padding-left'><".$this->layout['options']['label_container'].">$label</".$this->layout['options']['label_container'].">";
			$html .= '<select name="quantidade" class="'.$this->layout['option_class'].' quantidade" id="quantidade" required>';
			$array = array_values($array);
			$total = (isset($array[0]['estoque'])) ? $array[0]['estoque'] : $array[0];
				$html .= "<option value=''>Selecione a quantidade</option>";
			for ($i=1; $i <= $total ; $i++) { 
				$html .= "<option value='$i'>$i</option>";
			}
			$html .= '</select></div>';
		}
		return $html;
	}	

	protected function setSocial(){
		$itens = '';
		foreach ($this->layout['social_itens'] as $value) {
			if($value == 'facebook'){
				$url = $this->url_base.substr($this->getDI()->getShared('router')->getRewriteUri(), 1);
				$item = '<div class="fb-share-button" data-href="'.$url.'" data-layout="button"></div>';
			}else if($value == 'gplus'){
				$item = '<div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300"></div>
						<script type="text/javascript">
						  window.___gcfg = {lang: "pt-BR"};
						  (function() {
						    var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
						    po.src = "https://apis.google.com/js/platform.js";
						    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
						  })();
						</script>';
			}else if($value == 'twitter'){
				$item = "<a href='https://twitter.com/share' class='twitter-share-button' data-url='$url' data-lang='pt'>Tweetar</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>";
			}else{
				return false;
			}
			
			$itens .= parent::replaceWraper(2,
				array(
					$this->layout['social_item_class'],
					$item
				),
				$this->layout['social_item_wrap']
			);
		}
		return parent::replaceWraper(2,
				array(
					$this->layout['social_wrap_class'],
					$itens
				),
				$this->layout['social_wrap']
			);
	}

	protected function setAddCart(){
		return parent::replaceWraper(2,array(
			'addCart '.$this->layout['add_cart_class'],
			$this->layout['add_cart_text']
			),
			$this->layout['add_cart_wrap']
		);
	}
}
