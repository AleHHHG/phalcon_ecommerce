<?php

namespace Ecommerce\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\TextArea;


class LojaLayoutForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array()){
        $f = new select("template_nome",array(
            '7store' => '7store',
            'Bewear' => 'Bewear',
            'Bohase' => 'Bohase',
            'Classic' => 'Classic',
            'Everything' => 'Everything',
            'Hosoren' => 'Hosoren',
            'Micra' => 'Micra',
            'ShopMe' => 'ShopMe',
            'Smile' => 'Smile',
            'Unicase' => 'Unicase',
            )
        );   
        $f->setLabel('Template Nome');
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new text("imagem_size");
        $f->setLabel('Imagem Size');
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new text("thumbnail_size");
        $f->setLabel('Thumbnail Size');
        $f->setAttribute('class','form-control');
        $this->add($f);

        $f = new text("paginacao_tipo");
        $f->setLabel('Paginaçao Tipo');
        $f->setAttribute('class','form-control');
        $this->add($f);
    }

}