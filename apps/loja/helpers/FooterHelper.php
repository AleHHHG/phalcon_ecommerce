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
		'SOCIAl_LAYOUT' => array(
			'container_wrap' => '<div class="%1Ss">%2Ss</div>',
			'container_class' => '',
			'wrap' => '',
			'wrap_class' => '',
			'item_wrap' => '',
			'item_class' => '',
		),
		'COPYRIGHT_LAYOUT' => array(
			'logo' => true,
			'logo_color' => 'white'
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
			}else if($value['layout'] == 'SOCIAl_LAYOUT'){
				$html .= $this->getSocial($layout);
			}else{
				$html .= $this->getCopyright($layout);
			}
		}
		return $html;
	}

	public function getPagamentos($layout){
		$item = '';
		foreach (unserialize($this->ecommerce_options->bandeiras) as $value) {
			$item .= '<img src="'.$this->url_base.'img/loja/bandeiras/'.$value.'.png" class="'.$layout['img_class'].'" />'; 
		}
		return parent::replaceWraper(2,array(
				$layout['container_class'],
				$item
			),
			$layout['container_wrap']
		);
	}

	public function getCopyright($layout){
 		$item =  '&copy;'.date('Y').' '.$this->ecommerce_options->titulo.', Desenvolvido por ';
 		$item .= '<a href="http://www.webearte.com.br/">';
 		$item .= ($layout['logo']) ? '<img src="https://www.webearte.com.br/images/site/colors/orange/logo.png" alt="Webearte">' : 'Webearte';
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