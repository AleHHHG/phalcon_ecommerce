<?php

namespace Ecommerce\Admin\Forms;

use Phalcon\Forms\Form;
use Ecommerce\Admin\Models\Cores;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Numeric;

class ProdutoDetalheForm extends Form
{
	public function initialize($obj = null, $options = array())
    {
    	$detalhes = unserialize($this->ecommerce_options->produto_detalhe_options);
    	foreach ($detalhes as $key => $value) {
    		$chave = $key;
			$chave = new Select("detalhes[{$value['label']}][]", $value['referencia']::find(array('order' => 'nome ASC')), array(
	            'using' => array('nome', 'nome')
	        ));
	        $chave->setLabel($value['label']);
	        $chave->setAttribute('class','form-control '.$value['label']);
            if(!is_null($obj)){
                $chave->setDefault($obj->$value['label']);
            }
            $this->add($chave);
    	}
        #Input Valor
        $valor = new Text("detalhes[valor][]");
        $valor->setLabel("valor");
        $valor->setAttribute('class','form-control money');
        if(!is_null($obj)){
            $valor->setDefault($obj->valor);
        }

        $this->add($valor);

        #Input Estoque
        $estoque = new Numeric("detalhes[estoque][]");
        $estoque->setLabel("estoque");
        $estoque->setAttribute('class','form-control');
        $this->add($estoque);
        if(!is_null($obj)){
            $estoque->setDefault($obj->estoque);
        }
        if($this->ecommerce_options->produto_cubagem_detalhe == '1'){

            $peso = new Numeric("detalhes[peso][]");
            $peso->setLabel("peso");
            $peso->setAttribute('class','form-control');
            if(!is_null($obj)){
                $peso->setDefault($obj->peso);
            }
            $this->add($peso);

            $altura = new Numeric("detalhes[altura][]");
            $altura->setLabel("altura");
            $altura->setAttribute('class','form-control');
            $this->add($altura); 
            if(!is_null($obj)){
                $altura->setDefault($obj->altura);
            }

            $largura = new Numeric("detalhes[largura][]");
            $largura->setLabel("largura");
            $largura->setAttribute('class','form-control');
            $this->add($largura);
            if(!is_null($obj)){
                $largura->setDefault($obj->largura);
            } 

            $comprimento = new Numeric("detalhes[comprimento][]");
            $comprimento->setLabel("comprimento");
            $comprimento->setAttribute('class','form-control');
            $this->add($comprimento); 
            if(!is_null($obj)){
                $comprimento->setDefault($obj->comprimento);
            }
        }
        if(!is_null($obj)){
            $detalhe_id = new hidden("detalhes[detalhe_id][]");
            $detalhe_id->setAttribute('class','form-control detalhe_id dynamicId');
            $detalhe_id->setDefault($obj->detalhe_id);
            $this->add($detalhe_id); 
        }
    }

}