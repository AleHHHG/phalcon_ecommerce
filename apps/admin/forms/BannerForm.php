<?php

namespace Ecommerce\Admin\Forms;

use Ecommerce\Admin\Models\Posicao;
use Ecommerce\Admin\Models\Produtos;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\File;

class BannerForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {

        if (isset($options['edit'])) {
            $this->add(new Hidden("_id"));
        }


        $this->add(new Text("nome"));

        $produto = new Select("produto_id", Produtos::returnArrayForSelect(), array(
            'using' => array('_id', 'nome'),
            'useEmpty'   => true,
            'emptyText'  => 'Nenhum ...',
            'emptyValue' => null,
        ));
        $produto->setLabel('Produtos');
        $this->add($produto);

        $posicao = new Select("posicao_id", Posicao::find(), array(
            'using' => array('id', 'nome'),
        ));
        $posicao->setLabel('Local');
        $this->add($posicao);
        
        $this->add(new Text("link"));

        $descricao = new TextArea("descricao");
        $descricao->setLabel("Descrição");
        $descricao->setAttribute('rows','10');
        $this->add($descricao);
        
         $this->add(new Numeric("ordem"));

        $imagem = new File("imagem");
        $imagem->setLabel("Imagens");
        $this->add($imagem);
    }
}