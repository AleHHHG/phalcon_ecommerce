<?php

namespace Ecommerce\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\TextArea;


class LojaGeralConfigForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array()){

        $f = new text("url_base");
        $f->setLabel('URL BASE');
        $f->setAttribute('class','form-control');
        $this->add($f);
           
        $f = new select("ativo",array(
            '1' => 'Sim',
            '0' => 'Não',
            )
        );
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new select("orcamento",array(
            '1' => 'Sim',
            '0' => 'Não',
            )
        );
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new select("adicionar_carrinho",array(
            '1' => 'Sim',
            '0' => 'Não',
            )
        );
        $f->setLabel('Adicionar Carrinho');
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new text("plano");
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new numeric("limite_produtos");
        $f->setLabel('Limite de Produtos');
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new select("certificado",array(
                'certising' => 'Certising',
                'comodo' => 'Comodo',
                'norton' => 'Norton',
                'rapidssl' => 'Rapid SSL',
                'site_blindado' => 'Site Blindado',
            )
        );
        $f->setAttribute('class','form-control');
        $this->add($f);
    }

}