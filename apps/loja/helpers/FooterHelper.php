<?php
namespace Ecommerce\Loja\Helpers;
use Ecommerce\Loja\Helpers\BaseHelper;
class FooterHelper extends BaseHelper{
	
	public $options = array(
		'tipo' => array(),
	);
	protected $layouts = array(
		'BASE_LAYOUT' => array(
			'itens' => array(
				'descriçao','segurança','menu','informaçãoes','contato'
			),
			'container_wrap' => '<div class="%1Ss">%2Ss</div>',
			'container_class' => 'col-md-3',
			'title_wrap' => '<h3 class="%1Ss">%2Ss</h3>',
			'title_class' => '',
			'wrap' => '<ul class="%1Ss">%2Ss</ul>',
			'wrap_class' => '',
			'item_wrap' => '<li class="%1Ss"><a href="%2Ss">%3Ss</a></li>',
			'item_wrap_class' => ''
		),
		'PAGAMENTO_LAYOUT' => array(
			'container_wrap' => '<div class="%1Ss">%2Ss</div>',
			'container_class' => '',
			'wrap' => '<ul class="%1Ss">%2Ss</ul>',
			'wrap_class' => '',
			'isItem' => true,
			'item_wrap' => '<li class="%1Ss"><a href="%2Ss">%3Ss</a></li>',
			'item_wrap_class' => ''
		),
		'SOCIAL_LAYOUT' => array(
			'container_wrap' => '<div class="%1Ss">%2Ss</div>',
			'container_class' => '',
			'wrap' => '<ul class="%1Ss">%2Ss</ul>',
			'wrap_class' => '',
			'item_wrap' => '<li class="%1Ss"><a href="%2Ss">%3Ss</a></li>',
			'item_wrap_class' => '',
			'icone_layout' => 'default',
			'size' => 'medium',
			'color' => 'white'
		),
		'COPYRIGHT_LAYOUT' => array(
			'logo' => true,
			'logo_color' => 'white',
			'logo_size' => '200x46'
		),
	);


	public  function getHelper($options = array()){
		$this->options = $options + $this->options;
		$string = $this->setHelper();
		return $string;
	}

	public function setHelper(){
		$html = '';
		foreach ($this->options['tipo'] as $key => $value) {
			$layout = $value + $this->layouts[$value['layout']];
			if($value['layout'] == 'BASE_LAYOUT'){
				foreach ($layout['itens'] as $chave => $valor) {
					$html .= $this->getBase($layout,$valor);
				}
			}else if($value['layout'] == 'PAGAMENTO_LAYOUT'){
				$html .= $this->getPagamentos($layout);
			}else if($value['layout'] == 'SOCIAL_LAYOUT'){
				$html .= $this->getSocial($layout);
			}else{
				$html .= $this->getCopyright($layout);
			}
		}
		return $html;
	}

	public function getSocial($layout){
		$item = '';
		$array = array('facebook','google_plus','twitter');
		foreach ($array as $value) {
			if($layout['size'] == 'medium'){
				$size = 'fa-3x';
			}else if($layout['size'] == 'large'){
				$size = 'fa-5x';
			}else if($layout['size'] == 'small'){
				$size = 'fa-2x';
			}else{
				$size = 'fa-lg';
			}
			$icone_layout = ($layout['icone_layout'] != 'default') ? "-{$layout['icone_layout']}" : '';
	 		$i = '<i class="fa fa-'.str_replace('_', '-', $value).$icone_layout.' '.$size.'" style="color:'.$layout['color'].'"></i>';
	 		if($this->ecommerce_options->$value != ''){
		 		$item .=  parent::replaceWraper(3,
						array(
							$layout['item_wrap_class'],
							$this->ecommerce_options->$value,
							$i
						),
						$layout['item_wrap']
				);
			} 
		}
		$item  = parent::replaceWraper(2,
						array(
							$layout['wrap_class'],
							$item
						),
						$layout['wrap']
				);
		return parent::replaceWraper(2,array(
				$layout['container_class'],
				$item
			),
			$layout['container_wrap']
		);
	}

	public function getPagamentos($layout){
		$item = '';
		foreach (unserialize($this->ecommerce_options->bandeiras) as $value) {
			$i = '<img src="'.$this->url_base.'img/loja/bandeiras/'.$value.'.png" class="'.$layout['img_class'].'" />';
			if($layout['isItem']){
				$item .=  parent::replaceWraper(3,
					array(
						$layout['item_wrap_class'],
						'javascript:;',
						$i
					),
					$layout['item_wrap']
				); 
			}else{
				$item .= $i;
			}
		}
		if($layout['isItem']){
			$item  = parent::replaceWraper(2,
					array(
						$layout['wrap_class'],
						$item
					),
					$layout['wrap']
			);
		}
		return parent::replaceWraper(2,array(
				$layout['container_class'],
				$item
			),
			$layout['container_wrap']
		);
	}

	public function getCopyright($layout){
 		$item =  '&copy; '.date('Y').' '.$this->ecommerce_options->titulo.' - Desenvolvido por ';
 		$item .= '<a href="http://www.webearte.com.br/">';
 		if($layout['logo']){
	 		$size = explode('x', $layout['logo_size']);
			$src = "?src={$this->url_base}public/img/loja/webearte_{$layout['logo_color']}.png&q=90&w={$size[0]}&h={$size[1]}&zc=2";
		}
 		$item .= ($layout['logo']) ? '&nbsp<img src="'.$this->url_base.'public/timthumb'.$src.'" alt="Webearte">' : 'Webearte';
 		$item .= '</a>';
 		return $item;
	}

	public function getBase($layout,$valor){
		$html = parent::replaceWraper(2,array(
				$layout['title_class'],
				ucfirst($valor)
			),
			$layout['title_wrap']
		);
		$item = '';
		if($valor == 'descrição'){
			$html .= '<p>'.$this->ecommerce_options->descricao.'</p>';
		}else if($valor == 'segurança'){
			$html .= '<img src='.$this->url_base.'img/loja/certificado/'.$this->ecommerce_options->certificado.'.png class="img-responsive">';;
		}else if($valor == 'menu'){
			foreach (\Ecommerce\Admin\Models\Paginas::find() as $key => $value) {
				$item .=  parent::replaceWraper(3,
					array(
						$layout['item_wrap_class'],
						'javascript:;',
						$value->nome
					),
					$layout['item_wrap']
				);
			}
		}else if($valor == 'informaçãoes'){
			$array = array('termos_de_uso','politica_de_privacidade','politica_de_entrega');
			foreach ($array as $key => $value) {
				$nome = str_replace('politica','política',str_replace('_', ' ', $value));
				$item .=  parent::replaceWraper(3,
					array(
						$layout['item_wrap_class'],
						'javascript:;',
						ucfirst($nome).'<span class="display:none">'.$this->ecommerce_options->$value.'</span>'
					),
					$layout['item_wrap']
				);
			}
		}else if($valor == 'contato'){
			$array = array('email','telefone','endereco');
			foreach ($array as $value) {
				$item .=  parent::replaceWraper(3,
					array(
						$layout['item_wrap_class'],
						'javascript:;',
						$this->ecommerce_options->$value
					),
					$layout['item_wrap']
				);
			}
		}
		if($item != ''){
			$html .= parent::replaceWraper(2,
					array(
						$layout['wrap_class'],
						$item
					),
					$layout['wrap']
				);
		}
		return parent::replaceWraper(2,array(
				$layout['container_class'],
				$html
			),
			$layout['container_wrap']
		);
	}

}