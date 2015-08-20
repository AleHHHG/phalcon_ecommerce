<div class="page_header">
    <div class="container">
        <div class="page_header_info text-center">
            <div class="page_header_info_inner">
                <h2><?php echo $nome; ?></h2>
                <p>Nunc tincidunt consequat elit vitae placerat. Sed id ex vel tortor ultrices accumsan. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMBS -->
<div class="bcrumbs">
    <div class="container">
        <ul>
            <li><a href="#">Home</a></li>
            <li><?php echo $nome; ?></li>
        </ul>
    </div>
</div>


<div class="shop-content">
    <div class="container">
        <div class="row">
            <aside class="col-md-3">
                <?php echo $this->partial('template/_sidebar'); ?>
            </aside>
            <div class="col-md-9">
                <?php echo $this->helper->produto->getHelper(array('container_class' => 'product-item col-md-3', 'produto_thumbail_class' => 'item-thumb', 'categoria' => $indice, 'produto_info_class' => 'product-info', 'overlay_class' => 'product-overlay', 'overlay_options' => array('add_cart' => '<a href="%1Ss" class="addcart fa fa-shopping-cart"></a>', 'favorite' => '<a href="%1Ss" class="likeitem fa fa-heart-o"></a>'), 'produto_info_titulo_class' => 'product-title', 'produto_info_preco_class' => 'product-price')); ?>
            </div>
        </div>
    </div>
</div>