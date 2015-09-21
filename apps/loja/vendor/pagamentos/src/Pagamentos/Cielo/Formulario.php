<?php
namespace Pagamentos\Cielo;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Hidden;
class Formulario{

	public static function generate(){
		$form = new Form();
		//Numero do cartão
		foreach (self::rules() as $key => $value) {
			if($value['type'] == 'text'){
				$chave = new Text("pagamento[$key]");
			}else if($value['type'] == 'hidden'){
				$chave = new Hidden("pagamento[$key]");
			}else{
				$chave = new Select("pagamento[$key]", array(
		            'emptyText'  => 'Parcelas',
            		'emptyValue' => '',
		        ));
			}
			foreach ($value['attributos'] as $k => $v) {
				$chave->setAttribute($k,$v);
			}
			$form->add($chave);
		}
        return $form;
	}

	protected static function rules(){
		return array(
			'numero_cartao' => array(
				'type' => 'text',
				'attributos' =>array(
					'id' => 'numero-cartao',
					'class' => 'form-control',
					'disabled' => true,
					'placeholder' => 'Numero do Cartão',
				)
			),
			'nome_titular' => array(
				'type' => 'text',
				'attributos' =>array(
					'class' => 'form-control',
					'disabled' => true,
					'placeholder' => 'Nome Impresso no cartão',
				)
			),
			'mes' => array(
				'type' => 'text',
				'attributos' =>array(
					'class' => 'form-control one-half',
					'disabled' => true,
					'placeholder' => 'Mes ex: 06,10,12',
				)
			),
			'ano' => array(
				'type' => 'text',
				'attributos' =>array(
					'class' => 'form-control one-half',
					'disabled' => true,
					'placeholder' => 'Ano ex: 2015',
				)
			),
			'cvv' => array(
				'type' => 'text',
				'attributos' =>array(
					'class' => 'form-control',
					'disabled' => true,
					'placeholder' => 'Codigo Verificador',
				)
			),
			'parcelas' => array(
				'type' => 'select',
				'attributos' =>array(
					'class' => 'form-control',
					'disabled' => true,
					'placeholder' => 'Codigo Verificador',
				)
			),
			'bandeira' => array(
				'type' => 'hidden',
				'attributos' =>array(
					'id' => 'cartao-bandeira',
				)
			),

		);
	}
}

