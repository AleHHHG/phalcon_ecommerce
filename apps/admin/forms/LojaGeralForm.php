<?php

namespace Ecommerce\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\TextArea;
class LojaGeralForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {      
        $titulo = new Text("titulo");
        $titulo->setAttribute('class','form-control ');
        $this->add($titulo);

        $email = new Text("email");
        $email->setAttribute('class','form-control ');
        $this->add($email);

        $telefone = new Text("telefone");
        $telefone->setAttribute('class','form-control ');
        $this->add($telefone);

        $endereco = new Text("endereco");
        $endereco->setAttribute('class','form-control ');
        $this->add($endereco);

        $cep = new Text("cep");
        $cep->setLabel('CEP');
        $cep->setAttribute('data-mask','99999-999');
        $cep->setAttribute('class','form-control ');
        $this->add($cep);

        $descricao = new TextArea("descricao");
        $descricao->setLabel('Descrição da loja');
        $descricao->setAttribute('class','form-control ');
        $descricao->setAttribute('rows','5');
        $this->add($descricao);


        $produtos_por_pagina = new Numeric("produtos_por_pagina");
        $produtos_por_pagina->setLabel('Produtos por pagina');
        $produtos_por_pagina->setAttribute('class','form-control');
        $this->add($produtos_por_pagina);

        $produtos_destaque_quantidade = new Numeric("produtos_destaque");
        $produtos_destaque_quantidade->setLabel('Produtos destaques');
        $produtos_destaque_quantidade->setAttribute('class','form-control');
        $this->add($produtos_destaque_quantidade);

    }
}