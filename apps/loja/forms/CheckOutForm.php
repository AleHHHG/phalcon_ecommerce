<?php

namespace Ecommerce\Loja\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\File;

class CheckOutForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($model = null, $options = array())
    {
        $session = $this->di->getShared('session');

        $cep = new Text("endereco[cep]");
        $cep->setAttribute('class','form-control frete-calcular');
        $cep->setAttribute('data-mask','99999-999');
        $cep->setAttribute('required','required');
        $cep->setAttribute('placeholder','CEP');
        $cep->setAttribute('value', $session->get('cep'));
        $this->add($cep);

        $estado = new Text("endereco[estado]");
        $estado->setAttribute('class','form-control endereco-estado');
        $estado->setAttribute('required',true);
        $estado->setAttribute('readonly',true);
        $estado->setAttribute('placeholder','Estado');
        $this->add($estado);

        $cidade = new Text("endereco[cidade]");
        $cidade->setAttribute('class','form-control endereco-cidade');
        $cidade->setAttribute('required',true);
        $cidade->setAttribute('readonly',true);
        $cidade->setAttribute('placeholder','Cidade');
        $this->add($cidade);

        $logradouro = new Text("endereco[logradouro]");
        $logradouro->setAttribute('class','form-control endereco-logradouro');
        $logradouro->setAttribute('required',true);
        $logradouro->setAttribute('placeholder','Logradouro');
        $this->add($logradouro);

        $bairro = new Text("endereco[bairro]");
        $bairro->setAttribute('class','form-control endereco-bairro');
        $bairro->setAttribute('required',true);
        $bairro->setAttribute('placeholder','Bairro');
        $this->add($bairro);

        $numero = new Text("endereco[numero]");
        $numero->setAttribute('class','form-control');
        $numero->setAttribute('required',true);
        $numero->setAttribute('placeholder','Numero');
        $this->add($numero);

        $complemento = new Text("endereco[complemento]");
        $complemento->setAttribute('class','form-control');
        $complemento->setAttribute('placeholder','Complemento');
        $this->add($complemento);

        
    }
}