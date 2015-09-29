<?php

namespace Ecommerce\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Date;
use Ecommerce\Admin\Models\Cupons;
class CupomForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($model = null, $options = array())
    {
        $ativo = new Select(
            "ativo",
            array(
                '1' => 'Sim',
                '0' => 'Não'
            )
        );
        $ativo->setAttribute('class','form-control');
        $this->add($ativo);

        $nome = new Text("nome");
        $nome->setAttribute('class','form-control');
        $this->add($nome);

        $codigo = new Text("codigo");
        $codigo->setLabel("código");
        $codigo->setAttribute('class','form-control');
        $codigo->setAttribute('readonly','true');
        if(is_null($model)){
            $str = $this->getCodigo();
            if(Cupons::count(array('codigo = "'.$str.'"')) == 0){
                $codigo->setAttribute('value',$str);
            }else{
                $str = $this->getCodigo();
                $codigo->setAttribute('value',$str);
            }
        }
        $this->add($codigo);

        $quantidade = new Numeric("quantidade");
        $quantidade->setLabel("quantidade de cupons");
        $quantidade->setAttribute('class','form-control');
        $this->add($quantidade);

        $quantidade_uso = new Numeric("quantidade_uso");
        $quantidade_uso->setLabel("quantas utilização por usuário?");
        $quantidade_uso->setAttribute('class','form-control');
        $this->add($quantidade_uso);

        $valor = new Text("valor");
        $valor->setAttribute('class','form-control money');
        $this->add($valor);

        $valor_minimo = new Text("valor_minimo");
        $valor_minimo->setLabel('VALOR MíNIMO');
        $valor_minimo->setAttribute('class','form-control money');
        $this->add($valor_minimo);

        $data_expiracao = new Date("data_expiracao");
        $data_expiracao->setLabel('DATA EXPIRAÇÃO');
        $data_expiracao->setAttribute('class','form-control money');
        $this->add($data_expiracao);
    }

    public function getCodigo(){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVXZWY0123456789';
        $string = '';
         for ($i = 0; $i < 8; $i++) {
              $string .= $characters[rand(0, strlen($characters) - 1)];
         }
        return $string;
    }
}