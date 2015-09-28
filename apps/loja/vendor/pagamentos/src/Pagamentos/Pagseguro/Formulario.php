<?php
namespace Pagamentos\Pagseguro;
class Formulario{

	public static $session_url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions';
	public static $email = 'comercial@webearte.com.br';
	public static $token = 'C9B81840DE0B47208F641DC435D106C1';

	public static function generate(){
		$sessao = self::setSession();
		$html = self::getScript();
		$html .= self::getSession($sessao);
		return $html;
	}

	public static function setSession(){
    	$url = self::$session_url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  'email=' .self::$email.'&token='.self::$token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        if(curl_exec($ch) === false)
		{
		    echo 'Curl error: ' . curl_error($ch);
		    exit;
		}
		$exec = curl_exec($ch);
        curl_close($ch);
        $retorno = simplexml_load_string($exec);
        return $retorno; 
    }

    protected static function getScript(){
    	return '<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js "></script>';
    }

    protected static function getSession($sessao){
    	return '<script type="text/javascript">PagSeguroDirectPayment.setSessionId("'.$sessao->id.'");</script>';
    }

    protected static function getSenderHash(){
    	return '<script type="text/javascript">PagSeguroDirectPayment.getSenderHash();</script>';
    }

    protected static function getPaymentMethods($valor){
    	$script = '<script type="text/javascript">';
    	$script .= 'PagSeguroDirectPayment.getPaymentMethods({
			    amount: '.$valor.',
			    success: function(response) {
			    //meios de pagamento disponíveis
			     },
			    error: function(response) {
			    //tratamento do erro
			    },
			    complete: function(response) {
			    //tratamento comum para todas chamadas
			    }
			  })';
		$script .= '</script>';
		return $script;
    }
}

