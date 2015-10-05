<?php
namespace Pagamentos\Pagseguro;
use Ecommerce\Admin\Models\PedidoItens;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Clientes;
use Ecommerce\Admin\Models\Usuarios;
use Ecommerce\Admin\Models\Pedidos;
use Ecommerce\Admin\Models\Enderecos;
use Ecommerce\Loja\Helpers\BaseHelper;
class Pagamento{

    public static $url_teste = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions';
    public static $url_producao = 'https://ws.pagseguro.uol.com.br/v2/transactions';
	public static $currency = 'BRL';
    public static $producao = false;
    public static $email;
    public static $token;

    public static function init($producao,$dados,$opcoes){;
        self::$producao = $producao;
        self::$token = $opcoes['token'];
        self::$email = $opcoes['email'];
    	$retorno = self::sendRequest($dados);
        return $retorno;
    }

    public static function sendRequest($dados){
    	$url = (self::$producao) ? self::$url_producao : self::$url_teste; 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded',
            'charset: ISO-8859-1'
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(self::setDados($dados)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $exec = curl_exec($ch);
        curl_close($ch);
        $retorno = simplexml_load_string($exec);
        return $retorno; 
    }

	private static function setDados($post){
        $base = new BaseHelper;
        $pedido = Pedidos::findFirst("id = ".$post['pedido_id']."");
        $endereco = Enderecos::findFirst("relacao = 'pedidos' and id_relacao = ".$post['pedido_id']);
        $usuario = Usuarios::findFirst('id = '.$pedido->usuario_id);
        $cliente = Clientes::findFirst('usuario_id ='.$pedido->usuario_id);
        $fone = explode(')', $cliente->telefone);
        $dados['email'] = self::$email;
        $dados['token'] = self::$token;
        $dados['paymentMode'] = 'default';
        $dados['receiverEmail'] = self::$email;
        $dados['currency'] = self::$currency;
        $dados['reference'] = $post['pedido_id'];
        //Itens
        $itens = PedidoItens::find("pedido_id = ".$post['pedido_id']);
        foreach ($itens as $key => $value) {
            $indice = $key+1;
            $dados["itemId$indice"] = $value->produto_id;
            $dados["itemDescription$indice"] = Produtos::findById($value->produto_id)->nome;
            $dados["itemAmount$indice"] = $value->valor;
            $dados["itemQuantity$indice"] = $value->quantidade;
        }
        // Informações do pagamento
        if($post['creditCardToken'] != ''){
            $dados['paymentMethod'] = 'creditCard';
            $dados['creditCardToken'] = $post['creditCardToken'];
            $dados['installmentQuantity'] = $post['parcelas'];
            $dados['installmentValue'] = number_format($post['installmentValue'],2,'.','');
            $dados['creditCardHolderName'] = $post['nome_titular'];
            $dados['creditCardHolderBirthDate'] = $post['data_nascimento'];
            $dados['creditCardHolderCPF'] = $base->limpaString($post['cpf']);
            $dados['creditCardHolderAreaCode'] = str_replace('(', '', $fone[0]);
            $dados['creditCardHolderPhone'] = str_replace('-', '', $fone[1]);
            $dados['billingAddressPostalCode'] = str_replace('-', '', $endereco->cep);
            $dados['billingAddressStreet'] = $endereco->logradouro;
            $dados['billingAddressNumber'] = $endereco->numero;
            $dados['billingAddressComplement'] = $endereco->complemento;
            $dados['billingAddressDistrict'] = $endereco->bairro;;
            $dados['billingAddressCity'] = $endereco->Cidade->nome;
            $dados['billingAddressState'] = $endereco->Estado->sigla;
            $dados['billingAddressCountry'] = 'BRA';
        }else if($post['paymentMethod'] == 'ONLINE_DEBIT'){
             $dados['paymentMethod'] = 'eft';
             $dados['bankName'] = ($post['bankName'] == 'BANCO_BRASIL') ? 'bancodobrasil' : strtolower($post['bankName']);
        }else{
            $dados['paymentMethod'] = 'boleto';
        }
        //Hash
        $dados['senderHash'] = $post['hash'];
        //Dados do Comprador
        $dados['extraAmount'] = $pedido->frete;
        $dados['senderEmail'] = (self::$producao) ? $usuario->email : 'email@sandbox.pagseguro.com.br';
        $dados['senderName'] = $usuario->nome;
        if($cliente->pessoa_juridica){
            $dados['senderCNPJ'] = $cliente->documento;
        }else{
            $dados['senderCPF'] = $cliente->documento;
        }
        $dados['senderAreaCode'] = str_replace('(', '', $fone[0]);
        $dados['senderPhone'] = str_replace('-', '', $fone[1]);
        // Dados de endereco
        $dados['shippingAddressStreet'] = $endereco->logradouro;
        $dados['shippingAddressNumber'] = $endereco->numero;
        $dados['shippingAddressComplement'] = $endereco->complemento;
        $dados['shippingAddressDistrict'] = $endereco->bairro;
        $dados['shippingAddressPostalCode'] = str_replace('-', '', $endereco->cep);
        $dados['shippingAddressCity'] = $endereco->Cidade->nome;
        $dados['shippingAddressState'] = $endereco->Estado->sigla;
        $dados['shippingAddressCountry'] = 'BRA';
        return $dados;
	}
}

