<?php
namespace Ecommerce\Admin\Models;
class Mailer
{
	public $to;
	public $from;
	public $subject;
	public $fromName;
	public $username;
	public $template;
	public $conteudo;
	public $password;

	public function __construct($eo,$opcoes = array()){
		$this->to = $opcoes['email'];
		$this->from = $eo->email;
		$this->subject = $opcoes['assunto'];
		$this->fromName = $eo->titulo;
		$this->username = $eo->sendgrid_username;
		$this->password = $eo->sendgrid_password;
		$this->template = $eo->sendgrid_templateId;
		$this->conteudo = $opcoes['conteudo'];
	}



	public function send(){
		$options = array(
			'turn_off_ssl_verification' => true,
		);
		$sendgrid = new \SendGrid($this->username,$this->password,$options);
		$email = new \SendGrid\Email();
		$email
		    ->addTo($this->to)
		    ->setFrom($this->from)
		    ->setSubject($this->subject)
		 	->setFromName($this->fromName)
		    ->setHtml($this->conteudo)
		    ->setCc($this->from)
	      	->addFilter('templates', 'enabled', 1)
    		->addFilter('templates', 'template_id', $this->template)
		;
		try {
		    $sendgrid->send($email);
		    return array('enviado' => true, 'mensagem' => 'Enviado com sucesso');
		} catch(\SendGrid\Exception $e) {
		    $string = '';
		    foreach($e->getErrors() as $er) {
		        $string .= $e->getCode().' - '.$er.'<br/>';
		    }
		    return array('enviado' => false, 'mensagem' => $string);
		}
	}
}
	