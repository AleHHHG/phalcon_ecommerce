<?php

namespace Ecommerce\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Select;
class PagamentoForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($model = null, $options = array())
    {

        $op = unserialize($model->opcoes);
        foreach ($op as $key => $value) {
            $item = new Text('opcoes['.$key.']');
            $item->setLabel($key);
            $item->setAttribute('class','form-control');
             $item->setAttribute('value',$value);
            $this->add($item);
        }

        $ativo = new Select(
            "ativo",
            array(
                '1' => 'Sim',
                '0' => 'Não',
            )
        );
        $ativo->setAttribute('class','form-control');
        $this->add($ativo);

        $valor_minimo = new Text("valor_minimo");
        $valor_minimo->setLabel('valor mínimo');
        $valor_minimo->setAttribute('class','form-control money');
        $this->add($valor_minimo);

        if($model->id != 3){
            $maximo_parcela = new Numeric("maximo_parcela");
            $maximo_parcela->setAttribute('class','form-control');
            $maximo_parcela->setLabel('Maximo de parcelas');
            $this->add($maximo_parcela);

            $valor_minimo_parcela = new Text("valor_minimo_parcela");
            $valor_minimo_parcela->setLabel('Valor mínimo parcela');
            $valor_minimo_parcela->setAttribute('class','form-control money');
            $this->add($valor_minimo_parcela);


            $parcela_sem_juros = new Numeric("parcela_sem_juros");
            $parcela_sem_juros->setLabel('parcelas sem juros');
            $parcela_sem_juros->setAttribute('class','form-control');
            $this->add($parcela_sem_juros);

            $juros_parcela = new Text("juros_parcela");
            $juros_parcela->setLabel("juros parcela (% a.m)");
            $juros_parcela->setAttribute('class','form-control');
            $this->add($juros_parcela);
        }
    }
}