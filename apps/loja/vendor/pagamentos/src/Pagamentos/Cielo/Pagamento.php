<?php
namespace Pagamentos\Cielo;
class Pagamento{
	public static $producao;
	public static $cielo_numero;
	public static $cielo_chave;
	public static $numero_teste = '1006993069';
	public static $chave_teste = '25fbb99741c739dd84d7b06ec78c9bac718838630f30b112d033ce2e621b34f3';
	public static $url_teste = 'https://qasecommerce.cielo.com.br/servicos/ecommwsec.do';
	public static $url_producao = 'https://ecommerce.cbmp.com.br/servicos/ecommwsec.do';
	public static $bandeira; //Bandeira, no caso a Visa, outras bandeiras olhar no manual
    public static $nome_titular; //Nome do dono do cartão exatamente como impresso no mesmo.
    public static $numero_cartao; //Número do cartão de crédito, apenas números.
    public static $cvv; //Código de segurança do verso do cartão
    public static $indicador; //Se o cartão não tiver código de segurança o indicaro é zero, caso contrário um
    public static $produto;
    public static $ano;
    public static $mes;
    public static $parcelas = 1; //Quantidade total de parcelas
    public static $autorizar = '3'; //No caso a '3' é a chamada "autorização direta", para entender o que é e quais as outras opções consulte o manual
    public static $captura = 'true'; //A captura é quando após aprovada a transação você confirma para a operadora que quer o dinheiro, observe que se você não capturar, mesmo uma transação autorizada, não gerará débito para o usuário. No caso estou dizendo que se a transação for autorizada ela deve ser capturada, caso queira fazer a captura posteriormente devo usar false no lugar e posteriormente realizar a captura em outro procedimento.       
	public static $valor;
    public static $pedido_id;

    public static function setData($dados){
    	foreach ($dados as $key => $value) {
             self::$$key = $value;
    	}
        self::$parcelas = 1;
        // TRATAMENTO NECESSARIO DOS DADOS
        self::$indicador = (self::$cvv != '') ? '1' : '0'; 
        self::$produto = (self::$parcelas == '1')?'1':'2';
        self::$valor = (self::$producao) ? self::$valor : self::$valor.'00';    
    }

    public static function init($producao,$dados,$options){;
        self::setData($dados);
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
        $dados_ec->addChild('numero',self::$numero_teste);
        $dados_ec->addChild('chave',self::$chave_teste);
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

