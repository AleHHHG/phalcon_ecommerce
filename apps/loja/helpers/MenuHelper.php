<?php
namespace Ecommerce\Loja\Helpers;
use Ecommerce\Admin\Models\Categorias;
use Ecommerce\Loja\Helpers\BaseHelper;
use Phalcon\Filter;
class MenuHelper extends BaseHelper{
	
	public $options = array(
		'container'       => 'div',
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => '',
		'menu_id'         => '',
		'menu_wrap'      => '<ul id="%1Ss" class="%2Ss">%3Ss</ul>',
		'item_class' => '',
		'item_link_class' => '',
		'item_wrap' => '<li class="%1Ss"><a class="%2Ss" href="%3Ss">%4Ss</a> %5Ss</li>',
		'submenu' => true,
		'submenu_class' => '',
		'submenu_id' => '',
		'submenu_item_class' => '',
		'submenu_item_link_class' => '',
		'home' => true,
		'home_text' => 'HOME',
		'home_class' =>'',
		'home_id' => '',
		'mega_menu' => false,
		'mega_menu_container' =>'',
		'mega_menu_class' => '',
		'mega_menu_id' => '',
		'mega_menu_wrap' => '',
	);

	public function getHelper($options = array()){
		$options = $options + $this->options;
		$string = $this->setHelper($options);
		return $string;
	}


	public function setHelper($array){
		$html = '';
		$html .= "<{$array['container']} id='{$array['container_id']}' class='{$array['container_class']}'>";
		$replaces = array($array['menu_id'],$array['menu_class'],$this->setData($array));
		$html .= parent::replaceWraper(3,$replaces,$array['menu_wrap']);
		$html .= "</{$array['container']}>";
		return $html;
	}

	public function setData($array){
		$itens = '';
		if($array['home']){
			$replaces = array(
					$array['item_class'],
					$array['home_class'],
					$this->url_base,
					$array['home_text'],
					'',
				);
			$itens .= parent::replaceWraper(5,$replaces,$array['item_wrap']);
		}	
		foreach (Categorias::getDadosMenu() as $key => $value) {
			
			if($array['submenu']){
				$submenu =  $this->setSubmenu($value->subcategorias,$array);
			}else{
				$submenu = '';
			}

			$opcoes_sub = array($array['submenu_id'],$array['submenu_class'],$submenu);

			$replaces = array(
				$array['item_class'],
				$array['item_link_class'],
				parent::generateUrl($value->nome,$value->_id,'categoria'),
				$value->nome,
				($submenu != '') ? parent::replaceWraper(3,$opcoes_sub,$array['menu_wrap']) : '',
			);

			$itens .= parent::replaceWraper(5,$replaces,$array['item_wrap']);
		}
		return $itens;
	}

	public function setSubmenu($dados,$array){
		$submenu = '';
		if(!empty($dados)){
			foreach ($dados as $key => $value) {
				$replaces = array(
					$array['submenu_item_class'],
					$array['submenu_item_link_class'],
					parent::generateUrl($value['nome'],$value['id'],'categoria'),
					$value['nome'],
					'',
				);
				$submenu .= parent::replaceWraper(5,$replaces,$array['item_wrap']);
			}
		}
		return $submenu;
	}
}