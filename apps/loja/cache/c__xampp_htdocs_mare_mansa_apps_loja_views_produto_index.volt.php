<div class="breadcrumbs">
    <div class="container">
        <ul>
            <div class="row">
                <li>
                    <a href="<?php echo $this->url->getBaseUri(); ?>">Home</a>
                    <span>—›</span>
                </li>
                <li>
                    <a href="#">Produtos</a>
                    <span>—›</span>
                </li>
                <li><strong><?php echo $produto->nome; ?></strong></li>
            </div>
        </ul>
    </div>
</div>

<section class="main-container col1-layout">
    <div class="main container">
        <div class="col-main">
            <div class="row">
                <div class="product-view">
                    <div class="product-essential">
    <?php echo $this->helper->single->getHelper(array('tipos' => array('PRODUCT_IMAGES' => array('layout' => 'PRODUCT_IMAGES_LAYOUT', 'size' => 'col-lg-5 col-sm-6 col-md-4 col-xs-12 wow bounceInRight animated', 'container_class' => 'product-img-box', 'wrap' => '<div class="%1Ss">%2Ss</div>', 'wrap_class' => 'product-image', 'item_wrap' => '<div class="%1Ss">%2Ss</div>', 'item_class' => 'large-image', 'item_imagem_class' => 'cloud-zoom', 'unique_item' => true, 'navigation' => true, 'navigation_position' => 'BEFORE_ON_ITEM', 'navigation_wrap' => '<div class="flexslider flexslider-thumb"><ul class="%1Ss">%2Ss</ul></div>', 'navigation_class' => 'previews-list slides', 'produto' => $produto, 'detalhe' => $detalhe), 'PRODUCT_INFO' => array('container_class' => 'product-single', 'size' => 'product-shop col-lg-7 col-sm-6 col-md-8 col-xs-12 bounceInUp animated', 'title_wrap' => '<div class="%1Ss"><h1>%2Ss</h1></div>', 'title_class' => 'product-name', 'preco_class' => 'price-block', 'descricao_container' => 'p', 'add_cart_class' => 'button btn-cart', 'layout' => 'PRODUCT_INFO_LAYOUT', 'detalhe' => $detalhe, 'posicao' => $posicao, 'preco_wrap' => '<div class="%1Ss">
                    <div class="price-box">
                      <p class="special-price"> <span class="price-label">Special Price</span> <span id="product-price-48" class="price"> %2Ss </span> </p>
                    </div>
                  </div>', 'preco_class' => 'price-block', 'avaliacao_class' => 'ratings', 'add_cart_wrap' => '<div class="add-to-box"><a href="javascript:;" class="%1Ss"><i class="fa fa-shopping-cart"></i>&nbsp %2Ss</a><div>', 'produto' => $produto)))); ?>
                    </div>
                </div>
                <div class="product-collateral">
                    <?php echo $this->helper->single->getHelper(array('tipos' => array('PRODUCT_TABS' => array('layout' => 'PRODUCT_TABS_LAYOUT', 'produto' => $produto, 'nav_wrap_class' => 'product-tabs', 'container_class' => 'col-sm-12 wow bounceInUp animated"')))); ?>
                </div>
            </div>
        </div>
    </div>
</section>