<?php
namespace Ecommerce\Loja\Helpers;
class TopBarHelper extends BaseHelper{

	public $options = array(
		'container' => 'div',
		'container_class' => '',
		'wrap' => '<ul class="%1Ss">%2Ss</ul>',
		'wrap_class' => '',
		'item_wrap' => '<li class="%1Ss">%2Ss</li>',
		'item_class' => '',
		'actions' => array(),
	);
	private $to_cart;
	private $fone;
	private $email;
	private $my_account;
	private $wishilist;
	private $login;
	private $compare;

	public function __construct(){
		parent::__construct();
		$this->setVars();
	}

	public function getHelper($options = array()){
		$this->options = $options + $this->options;
		$string = $this->setHelper();
		return $string;
	}

	protected function setHelper(){
		$html = '';
		if($this->options['container'] != ''){
			$html .= "<{$this->options['container']} class='{$this->options['container_class']}'>";
			$html .= parent::replaceWraper(2,
				array(
					$this->options['wrap_class'],
					$this->getActions()
				),
				$this->options['wrap']
			);
			$html .= "</{$this->options['container']}>";
		}else{
			$html .= parent::replaceWraper(2,
				array(
					$this->options['wrap_class'],
					$this->getActions()
				),
				$this->options['wrap']
			);
		}
		return $html;
	}

	protected function getActions(){
		$html = '';
		foreach ($this->options['actions'] as $value) {
			$html .= parent::replaceWraper(2,
				array(
					$this->options['item_class'],
					$this->$value
				),
				$this->options['item_wrap']
			);
		}
		return $html;
	}

	private function setVars(){
		$this->to_cart = "<a href='{$this->url_base}cart'><i class='fa fa-cart'></i> Carrinho</a>";
		$this->fone = "<a href='javascript:;' class='header-telefone'><i class='fa fa-phone'></i> Entre em contato: {$this->ecommerce_options->telefone}</a>";
		$this->email = "<a href='javascript:;' class='header-email'><i class='fa fa-envelope-o'></i> {$this->ecommerce_options->email}</a>";
		if($this->session->logado){
			$this->my_account = "<a href='{$this->url_base}user'>Minha Conta</a>";
		}
		$this->wishilist = '<a href="#">Lista de Desejos</a>';
		$this->compare = "<a href='{$this->url_base}comparacao'>Comparação <span class='badge comparacao-count'>".count($this->session->get('comparacao'))."</span> </a>";
		if(!$this->session->logado){
			$this->login = "<a href='{$this->url_base}user/login'>Login</a>";
		}else{
			$this->login = "<a href='{$this->url_base}user/logout'>Sair</a>";
		}
	}
	
}