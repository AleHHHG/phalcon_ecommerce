<?php
namespace Ecommerce\Loja\Helpers;
class SingleHelper extends BaseHelper {

	public $options = array(
		'tipos' => array()
	);

	public $navigation_positions = array(
		'BEFORE_ITEM','AFTER_ITEM','AFTER_ON_ITEM','BEFORE_ON_ITEM'
	);

	public $layouts = array(
		'PRODUCT_INFO_LAYOUT' => array(
			'size' => 'col-md-6',
			'container' => 'div',
			'container_class' => '',
			'container_id' => '',
			'title_wrap' => '<h1 class="%1Ss">%2Ss</h1>',
			'title_class' => '',
			'avaliacao' => true,
			'avaliacao_class' => '', 
			'avaliacao_wrap' => '<div class="%1Ss">%2Ss</div>',
			'preco_wrap' => '<div class="%1Ss">%2Ss</div>',
			'preco_class' => '',
			'descricao_container' => 'div',
			'descricao_class' => '',
			'add_cart_wrap' => '<a href="javascript:;" class="%1Ss">%2Ss</a>',
			'add_cart_class' => '',
			'add_cart_text' => 'Adionar ao carrinho',
			'social' => true,
			'social_wrap' => '<ul class="%1Ss">%2Ss</ul>',
			'social_wrap_class' => '',
			'social_item_wrap' => '<li class="%1Ss">%2Ss</li>',
			'social_item_class' => '',
			'social_itens' => ['facebook','twitter','gplus'],
			'option_class' => 'form-control',
			'options' => array(
				'label' => true,
				'label_container' => 'h5',
				'label_class' => '',
				'container_size' => 'col-md-4'
			),
		),
		'PRODUCT_IMAGES_LAYOUT' => array(
			'size' => 'col-md-6',
			'container' => 'div',
			'container_class' => '',
			'wrap' => '<ul class="%1Ss">%2Ss</ul>',
			'wrap_class' => '',
			'item_wrap' => '<li class="%1Ss">%2Ss</li>',
			'item_class' => '',
			'item_imagem_wrap' => '<img src="%1Ss" %2Ss />',
			'item_imagem_attr' => array(),
			'unique_item' => false,
			'navigation' => false,
			'navigation_container' =>'div',
			'navigation_class' => '',
			'navigation_wrap' => '<ul class="%1Ss">%2Ss</ul>',
			'navigation_wrap_class' => '',
			'navigation_item' => '<li id="%1Ss" class="%2Ss">%3Ss</li>',
			'navigation_position' => 'BEFORE_ITEM',
			'navigation_item_class' =>'',
			'navigation_imagem_wrap' => '<img src="%1Ss" %2Ss />',
			'navigation_imagem_attr' => array(),
			'navigation_item_id' =>'',
			'navigation_item_imagem_class' => '',
			'identificador' => false,
			'identificador_position' => 'navigation',
		),
		'PRODUCT_TABS_LAYOUT' => array(
			'container' => 'div',
			'container_class' => '',
			'nav_wrap' => '<ul class="nav nav-tabs %1Ss">%2Ss</ul>',
			'nav_wrap_class' => '',
			'nav_item_wrap' => '<li role="presentation" class="%1Ss"><a href="%2Ss" role="tab" data-toggle="tab">%3Ss</a></li>',
			'nav_item_class' => '',
			'tab_container' => 'div',
			'tab_class' => 'tab-content',
			'item_container' => 'div',
			'item_class' => 'tab-pane',
			'tab_itens' => array('descrição','avaliação')
		)
	);

	public function getHelper($options){
		$options = $options + $this->options;
		return $this->setHelper($options);
	}

	public function setHelper($array){
		$html = '';
		if(!empty($array['tipos'])){
			foreach($array['tipos'] as $key => $value) {
				$layout = $value + $this->layouts[$value['layout']];
				if($key == 'PRODUCT_INFO'){
					$product_info = new ProductInfoHelper($layout);
					$html .= $product_info->getProductInfo();	
				}else if($key == 'PRODUCT_IMAGES'){
					$product_images = new ProductImageHelper($layout);
					$html .= $product_images->getProductImages();	
				}else if($key == 'PRODUCT_TABS'){
					$product_tabs = new ProductTabsHelper($layout);
					$html .= $product_tabs->getProductTabs();
				}
			}
		}
		return $html;
	}
}