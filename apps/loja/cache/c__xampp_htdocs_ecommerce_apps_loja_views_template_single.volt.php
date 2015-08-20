<div class="bcrumbs">
    <div class="container">
        <ul>
            <li><a href="<?php echo $this->url->getBaseUri(); ?>">Home</a></li>
            <li><a href="#">Produtos</a></li>
            <li><?php echo $produto->nome; ?></li>
        </ul>
    </div>
</div>
<div class="shop-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php echo $this->helper->single->getHelper(array('tipos' => array('PRODUCT_IMAGES' => array('layout' => 'PRODUCT_IMAGES_LAYOUT', 'size' => 'col-md-5', 'container_class' => 'ps-slider', 'wrap' => '', 'item_wrap' => '<div class="%1Ss">%2Ss</div>', 'item_class' => 'ps-img', 'identificador' => true, 'navigation' => true, 'navigation_class' => 'ps-slider-nav', 'navigation_item_id' => 'ps-img', 'navigation_item_imagem_class' => 'img-responsive', 'produto' => $produto, 'detalhe' => $detalhe), 'PRODUCT_INFO' => array('container_class' => 'product-single', 'size' => 'col-md-7', 'title_wrap' => '<h3 class="%1Ss">%2Ss</h3>', 'preco_class' => 'ps-price', 'descricao_container' => 'p', 'add_cart_class' => 'addtobag', 'layout' => 'PRODUCT_INFO_LAYOUT', 'detalhe' => $detalhe, 'posicao' => $posicao, 'avaliacao_class' => 'ratings', 'produto' => $produto)))); ?>
                </div>
                <br clear="all"/>
                <div class="row">
                     <?php echo $this->helper->single->getHelper(array('tipos' => array('PRODUCT_TABS' => array('layout' => 'PRODUCT_TABS_LAYOUT', 'produto' => $produto)))); ?>
                </div>
                <br clear="all"/>
            </div>
        </div>
    </div>
</div>
