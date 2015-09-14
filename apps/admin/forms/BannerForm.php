<?php

namespace Ecommerce\Admin\Forms;

use Ecommerce\Admin\Models\Posicao;
use Ecommerce\Admin\Models\Produtos;
use Ecommerce\Admin\Models\Categorias;
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

        $this->add(new Text("nome"));

        $produto = new Select("produto_id", Produtos::returnArrayForSelect(), array(
            'using' => array('_id', 'nome'),
            'useEmpty'   => true,
            'emptyText'  => 'Nenhum ...',
            'emptyValue' => null,
        ));
        $produto->setLabel('Produto');
        $this->add($produto);

        $categoria = new Select("categoria_id", Categorias::returnArrayForSelect(), array(
            'using' => array('_id', 'nome'),
            'useEmpty'   => true,
            'emptyText'  => 'Nenhum ...',
            'emptyValue' => null,
        ));
        $categoria->setLabel('Categoria');
        $this->add($categoria);

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

        $this->add(new Hidden("imagens"));
    }
}