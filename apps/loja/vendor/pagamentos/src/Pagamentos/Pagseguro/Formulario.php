<?php
namespace Pagamentos\Pagseguro;
use Moltin\Cart\Storage\Session;
use Moltin\Cart\Identifier\Cookie;
use Moltin\Cart\Cart;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Hidden;
class Formulario{

	public static $session_url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions';
	public static $email;
	public static $token;

	public static function generate($opcoes = array()){
		$cart = new Cart(new Session, new Cookie);
		self::$token = $opcoes['token'];
        self::$email = $opcoes['email'];
		$sessao = self::setSession();
		$html = self::getScript();
		$html .= '<div class="checkout-pagseguro">';
		$html .= '<div class="page-header"><h5>Cartão de crédito</h5></div>';
		$html .= self::setForm();
		$html .= '</div>';
		$html .= self::getSession($sessao);
		$html .= self::getPaymentMethods($cart->total());
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

    protected static function getPaymentMethods($valor){
    	$script = '<script type="text/javascript">';
    	$script .= 'PagSeguroDirectPayment.getPaymentMethods({
			    amount: '.$valor.',
			    success: function(response) {
			    	$.each(response.paymentMethods, function( key, value ) {
						if(key != "BALANCE" && key != "CREDIT_CARD"){
							var html = "<div class=page-header><h5>"+value.name+"</h5></div>";
							$.each(value.options, function( chave, valor ) {
								url = "https://stc.pagseguro.uol.com.br/"+valor.images.MEDIUM.path
								html += "<a href=javascript:; class=pagseguro-forma-pagamento data-tipo="+value.name+" data-name="+valor.name+"><img src="+url+" /></a>";
							})
							$(".checkout-pagseguro").append(html)
						}
					});
					var html = "";
					html += "<input type=hidden id=paymentMethod name=pagamento[paymentMethod] />"
					html += "<input type=hidden id=bankName name=pagamento[bankName] />"
					html += "<input type=hidden id=creditCardToken name=pagamento[creditCardToken] />"
					html += "<input type=hidden name=pagamento[hash] value="+PagSeguroDirectPayment.getSenderHash()+" >";
					$(".checkout-pagseguro").append(html)
			    	$(".pagseguro-forma-pagamento").click(function(){
						$(".pagseguro-forma-pagamento").removeClass("active")
						$(this).addClass("active")
						var tipo = $(this).data("tipo");
						var name = $(this).data("name");
						if(tipo == "ONLINE_DEBIT"){
							$("#bankName").val(name)
						}
						$("#paymentMethod").val(tipo)
					})
			    },
			    error: function(response) {
			    },
			  })';
		$script .= '</script>';
		return $script;
    }

    private static function setForm(){
		$form = new Form();
		//Numero do cartão
		foreach (self::rules() as $key => $value) {
			if($value['type'] == 'text'){
				$chave = new Text("pagamento[$key]");
			}else if($value['type'] == 'hidden'){
				$chave = new Hidden("pagamento[$key]");
			}else{
				$arr = array();
				if($key == 'mes'){
					$arr[''] = 'Mês de vencimento';
					for ($i=1; $i <= 12 ; $i++) { 
						$arr[$i] = $i;
					}
				}else if($key == 'ano'){
					$arr[''] = 'Ano de vencimento';
					for ($i=date('Y'); $i <= date('Y',strtotime('+ 20 years')) ; $i++) { 
						$arr[$i] = $i;
					}
				}else{
					$arr[''] = 'Numero de parcelas';
				}
				$chave = new Select("pagamento[$key]",$arr);
			}
			foreach ($value['attributos'] as $k => $v) {
				$chave->setAttribute($k,$v);
			}
			$form->add($chave);
		}
        $html = '';
        foreach ($form as $key => $value) {
         	$html .= "<div class='form-group'>".$value."</div>";
        }
        return $html;
    }

    protected static function rules(){
		return array(
			'data_nascimento' => array(
				'type' => 'text',
				'attributos' =>array(
					'disabled' => true,
					'class' => 'form-control',
					'placeholder' => 'Data Nascimento',
					'data-mask' => '99/99/9999'
				)
			),
			'cpf' => array(
				'type' => 'text',
				'attributos' =>array(
					'disabled' => true,
					'class' => 'form-control',
					'placeholder' => 'CPF',
					'data-mask' => '999.999.999-99'
				)
			),
			'numero_cartao' => array(
				'type' => 'text',
				'attributos' =>array(
					'disabled' => true,
					'class' => 'numero-cartao form-control pagseguro-numero_cartao',
					'placeholder' => 'Numero do Cartão',
				)
			),
			'nome_titular' => array(
				'type' => 'text',
				'attributos' =>array(
					'disabled' => true,
					'class' => 'form-control',
					'placeholder' => 'Nome impresso no cartão',
				)
			),
			'mes' => array(
				'type' => 'select',
				'attributos' =>array(
					'disabled' => true,
					'class' => 'form-control one-half pagseguro-mes',
					'placeholder' => 'Mes ex: 06,10,12',
					'style' => 'display:none',
				),
				'emptyText' => 'Mês'
			),
			'ano' => array(
				'type' => 'select',
				'attributos' =>array(
					'disabled' => true,
					'class' => 'form-control one-half pagseguro-ano',
					'placeholder' => 'Ano ex: 2015',
					'style' => 'display:none'
				),
				'emptyText' => 'Ano'
			),
			'cvv' => array(
				'type' => 'text',
				'attributos' =>array(
					'disabled' => true,
					'class' => 'form-control pagseguro-cvv',
					'placeholder' => 'Codigo Verificador',
					'style' => 'display:none'
				)
			),
			'parcelas' => array(
				'type' => 'select',
				'attributos' =>array(
					'disabled' => true,
					'class' => 'form-control pagseguro-parcelas',
					'placeholder' => 'Parcelas',
					'style' => 'display:none'
				),

			),
			'bandeira' => array(
				'type' => 'hidden',
				'attributos' =>array(
					'disabled' => true,
					'class' => 'cartao-bandeira',
				),
			),
			'installmentValue' => array(
				'type' => 'hidden',
				'attributos' =>array(
					'disabled' => true,
					'class' => 'valor_parcela',
				),
			),
		);
	}
}

