<?php
namespace Pagamentos\Pagseguro;
class Pagamento{

	public static $producao;
    public static $email;
	public static $token;
	public static $currency = 'BRL';
	public static $reference;

    public static function setData($dados){
    	  
    }

    public static function init($producao,$dados,$opcoes){;
        self::$producao = $producao;
        self::setData($dados);
        self::$cielo_numero = ($producao) ? $opcoes['numero']: self::$numero_teste;
        self::$cielo_chave = ($producao) ? $opcoes['chave']: self::$chave_teste;
    	$retorno = self::sendRequest();
        return $retorno;
    }

    public static function sendRequest(){
    	$url = (self::$producao) ? self::$url_producao : self::$url_teste; 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  'mensagem=' . self::setXml());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        $exec = curl_exec($ch);
        curl_close($ch);
        $retorno = simplexml_load_string($exec);
        return $retorno; 
    }

	private static function setXml(){
        $xml = new \SimpleXMLElement("<?xml version='1.0' encoding='ISO-8859-1'?> <requisicao-transacao id='".self::$pedido_id."' versao='1.1.1'/>");
        $dados_ec =  $xml->addChild('dados-ec');
        $dados_ec->addChild('numero',self::$cielo_numero);
        $dados_ec->addChild('chave',self::$cielo_chave);
        $dados_portador = $xml->addChild('dados-portador');
        $dados_portador->addChild('numero',self::$numero_cartao);
        $dados_portador->addChild('validade',self::$ano.self::$mes);
        $dados_portador->addChild('indicador',self::$indicador);
        $dados_portador->addChild('codigo-seguranca',self::$cvv);
        $dados_portador->addChild('nome-portador','teste');
        $dados_pedido = $xml->addChild('dados-pedido');
        $dados_pedido->addChild('numero',self::$pedido_id);
        $dados_pedido->addChild('valor',self::$valor);
        $dados_pedido->addChild('moeda','986');
        $dados_pedido->addChild('data-hora',date('Y-m-d\TH:i:s'));
        $dados_pedido->addChild('descricao','sd');
        $dados_pedido->addChild('idioma','PT');
        $forma_pagamento = $xml->addChild('forma-pagamento');
        $forma_pagamento->addChild('bandeira',self::$bandeira);
        $forma_pagamento->addChild('produto',self::$produto);
        $forma_pagamento->addChild('parcelas',self::$parcelas);
        $xml->addChild('url-retorno','http://webearte.com.br');
        $xml->addChild('autorizar',self::$autorizar);
        $xml->addChild('capturar',self::$captura);
        return $xml->asXml();
	}
}

