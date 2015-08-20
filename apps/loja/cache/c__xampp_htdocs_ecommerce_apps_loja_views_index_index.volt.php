<div class="slider-wrap">
	<div class="tp-banner-container">
		<?php echo $this->helper->banner->getHelper(array('container_class' => 'tp-banner', 'caption' => 'false')); ?>
	</div>
</div>

<br clear='all'/>
<div class="clearfix"></div>
<br clear='all'/>

<!-- FEATURED PRODUCTS -->
<div class="featured-products">
	<div class="container">
	    <div class="row">
	        <h5 class="heading"><span>Destaques</span></h5>
	        <?php echo $this->helper->produto->getHelper(array('quantidade_itens' => 3, 'container_class' => 'product-item col-md-4', 'produto_thumbail_class' => 'item-thumb', 'destaque' => 1, 'produto_info_class' => 'product-info', 'overlay_class' => 'product-overlay', 'overlay_options' => array('WISH_LIST', 'COMPARE'), 'produto_info_titulo_class' => 'product-title', 'produto_info_preco_class' => 'product-price', 'opcoes' => array('PRECO', 'CORES'))); ?>
		</div>
	</div>
</div>

<div class="policy-item parallax-bg1">
	<div class="container">
	    <div class="row">
	        <div class="col-md-3">
	            <div class="pi-wrap text-center">
	                <i class="fa fa-plane"></i>
	                <h4>Free shipping<span>Free shipping on all UK order</span></h4>
	                <p>Nulla ac nisi egestas metus aliquet euismod. Sed pulvinar lorem at pretium.</p>
	            </div>
	        </div>
	        <div class="col-md-3">
	            <div class="pi-wrap text-center">
	                <i class="fa fa-money"></i>
	                <h4>Money Guarantee<span>30 days money back guarantee !</span></h4>
	                <p>Curabitur ornare urna enim, et lacinia purus tristique eulla eget feugiat diam.</p>
	            </div>
	        </div>
	        <div class="col-md-3">
	            <div class="pi-wrap text-center">
	                <i class="fa fa-clock-o"></i>
	                <h4>Store Hours<span>Open: 9:00AM - Close: 21:00PM</span></h4>
	                <p>Etiam egestas purus eget sagittis lacinia. Morbi vel elit nec eros iaculis.</p>
	            </div>
	        </div>
	        <div class="col-md-3">
	            <div class="pi-wrap text-center">
	                <i class="fa fa-life-ring"></i>
	                <h4>Support 24/7<span>We support online 24 hours a day</span></h4>
	                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit integer congue.</p>
	            </div>
	        </div>
	    </div>
	</div>
</div>

<br clear='all'/>
<div class="clearfix"></div>
<br clear='all'/>

<!-- FEATURED PRODUCTS -->
<div class="featured-products">
	<div class="container">
	    <div class="row">
	        <h5 class="heading"><span>Lancamentos</span></h5>
	        <?php echo $this->helper->produto->getHelper(array('quantidade_itens' => 4, 'container_class' => 'product-item col-md-3', 'produto_thumbail_class' => 'item-thumb', 'lancamento' => 1, 'destaque' => 0, 'produto_info_class' => 'product-info', 'overlay_class' => 'product-overlay', 'overlay_options' => array('WISH_LIST', 'COMPARE'), 'produto_info_titulo_class' => 'product-title', 'produto_info_preco_class' => 'product-price', 'opcoes' => array('PRECO', 'CORES'))); ?>
		</div>
	</div>
</div>