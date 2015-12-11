<?php
namespace Ecommerce\Loja\Helpers;
use Ecommerce\Admin\Models\Categorias;
class SearchHelper extends BaseHelper{
	
	public $options = array(
		'container'       => '<div id="%1Ss" class="%2Ss">%3Ss</div>',
		'container_id'    => '',
		'container_class' => '',
		'categorias' => true,
		'categorias_container' => '<div id="%1Ss" class="%2Ss">%3Ss</div>',
		'categoria_id'    => '',
		'categoria_class' => '',
		'categoria_select_class' => 'form-control',
		'form_class' => '',
		'input_class' => 'form-control',
		'button_class' => '',
		'button_text' => '<i class="fa fa-search"></i>',
		'token_input' => true
	);

	public function getHelper($options = array()){
		$this->options = $options + $this->options;
		$string = $this->setHelper($this->options);
		return $string;
	}


	public function setHelper(){
		$html = parent::replaceWraper(3,
			array(
				$this->options['container_id'],
				$this->options['container_class'],
				$this->setData()
			),
			$this->options['container']
		);
		return $html;
	}

	protected function setData(){
		$html = '<form class="'.$this->options['form_class'].'" action="'.$this->url_base.'produtos/search" id="search" method="post">';
		if($this->options['categorias']){
			$html .= parent::replaceWraper(3,
				array(
					$this->options['categoria_id'],
					$this->options['categoria_class'],
					$this->getCategorias()
				),
				$this->options['categorias_container']
			);
		}
		$html .= $this->getInput();
		$html .= '<button type="submit" class="'.$this->options['button_class'].'" id="search-submit">'.$this->options['button_text'].'</button>';
		$html .= '</form>';
		return $html;
	}


	protected function getCategorias(){
		$categorias = Categorias::find(array('conditions' => array('parent' => null)));
		$html = '<select id="search-categoria" class="'.$this->options['categoria_select_class'].'">';
		$html .= '<option value="">Todas</option>';
		foreach ($categorias as $key => $value) {
			$html .= '<option value="'.$value->_id.'">'.$value->nome.'</option>';
		}
		$html .= '</select>';
		return $html;
	}

	protected function getInput(){		
		$html = '<div class="form-group">';
		if($this->options['token_input']){		
			$html .= '<input id="input-search" type="text" class="search-fake '.$this->options['input_class'].'" data-url="'.$this->url_base.'produtos/search" placeholder="Digite o que procura" />';
			$html .= '<input type="hidden" name="search" id="search-real"/>';
		}
		else{
			$html .= '<input type="text" class="form-control" name="search" id="search-real"/>';
		}
		$html .= '</div>';
		return $html;
	}

}