<?php
namespace Ecommerce\Loja\Helpers;
use Ecommerce\Admin\Models\Mailer;
use Ecommerce\Admin\Helpers\Utiliarios;
use Moltin\Cart\Cart;
class MailerHelper extends BaseHelper{
	
	public $opcoes;	


	public function getHelper($opcoes = array()){
		$tipo = $opcoes['tipo'];
		$this->opcoes = $opcoes;
		$this->$tipo();
	}

	protected function pedidoCriado(){
		$array = array(
			'email' => $this->session->get('email'),
			'assunto' => 'Pedido Realizado Nº '.$this->opcoes['pedido_id'],
			'conteudo' => parent::replaceWraper(3,array(
			 	$this->opcoes['pedido_id'],
				$this->session->get('nome'),
			 	'<a href='.$this->url_base.'user/pedido/'.$this->opcoes['pedido_id'].'/>Acompanhe seu pedido</a>',
				),$this->ecommerce_options->email_pedido_criado)
		);
		$this->sendMail($array);
	}

	protected function pedidoAprovado(){
		$array = array(
			'email' => $this->session->get('email'),
			'assunto' => 'Pedido Realizado Nº '.$this->opcoes['pedido_id'],
			'conteudo' => parent::replaceWraper(3,array(
				$this->opcoes['pedido_id'],
				$this->session->get('nome'),
			 	'<a href='.$this->url_base.'user/pedido/'.$this->opcoes['pedido_id'].'/>Acompanhe seu pedido</a>',
				),$this->ecommerce_options->email_pedido_aprovado)
		);
		$this->sendMail($array);
	}

	protected function pedidoTransporte(){
		$array = array(
			'email' => $this->session->get('email'),
			'assunto' => 'Pedido Realizado Nº '.$this->opcoes['pedido_id'],
			'conteudo' => parent::replaceWraper(3,array(
				$this->opcoes['pedido_id'],
				$this->session->get('nome'),
			 	'<a href='.$this->url_base.'user/pedido/'.$this->opcoes['pedido_id'].'/>Acompanhe seu pedido</a>',
				),$this->ecommerce_options->email_pedido_transporte)
		);
		$this->sendMail($array);
	}

	protected function pedidoConcluido(){
		$array = array(
			'email' => $this->session->get('email'),
			'assunto' => 'Pedido Realizado Nº '.$this->opcoes['pedido_id'],
			'conteudo' => parent::replaceWraper(2,array(
				$this->session->get('nome'),
				$this->opcoes['pedido_id'],
				),$this->ecommerce_options->email_pedido_concluido)
		);
		$this->sendMail($array);
	}

	protected function pedidoCancelado(){
		$array = array(
			'email' => $this->session->get('email'),
			'assunto' => 'Pedido Realizado Nº '.$this->opcoes['pedido_id'],
			'conteudo' => parent::replaceWraper(3,array(
				$this->session->get('nome'),
				$this->opcoes['pedido_id'],
				$this->opcoes['pedido_id'],
				),$this->ecommerce_options->email_pedido_cancelado)
		);
		$this->sendMail($array);
	}

	private function sendMail($array){
		$email = new Mailer($this->ecommerce_options,$array);
		$email->send();
	}

}