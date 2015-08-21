<div id="magik-slideshow" class="magik-slideshow">
	<div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container' >
			<?php echo $this->helper->banner->getHelper(array('container_id' => 'rev_slider_4', 'container_class' => 'rev_slider fullwidthabanner', 'caption_options' => array('TITLE', 'DESCRIPTION'), 'title_options' => array(array('class' => 'tp-caption sft large_bold_white_25', 'data-x' => '150', 'data-y' => '200', 'data-endspeed' => '500', 'data-speed' => '500', 'data-start' => '1300', 'data-easing' => 'Linear.easeNone'), array('class' => 'tp-caption sfb large_bold_white_25', 'data-x' => '150', 'data-y' => '200', 'data-endspeed' => '500', 'data-speed' => '500', 'data-start' => '1300', 'data-easing' => 'Linear.easeNone')), 'description_options' => array(array('class' => 'tp-caption sfl medium_text ', 'data-x' => '150', 'data-y' => '280', 'data-endspeed' => '500', 'data-speed' => '500', 'data-start' => '1300', 'data-easing' => 'Linear.easeNone'), array('class' => 'tp-caption sft medium_text', 'data-x' => '150', 'data-y' => '300', 'data-endspeed' => '500', 'data-speed' => '500', 'data-start' => '1300', 'data-easing' => 'Linear.easeNone')))); ?>
	</div>
</div>

<div class="offer-banner-section">
 	<?php echo $this->helper->banner->getHelper(array('container_class' => 'container', 'container_id' => '', 'slide_wrap' => '<div id="%1Ss" class="%2Ss">%3Ss</div>', 'slide_class' => 'row', 'slide_item_wrap' => '<div id="%1Ss" class="%2Ss">%3Ss %4Ss</div>', 'slide_item_class' => 'col over-effect col-lg-4 col-xs-12 col-sm-4 wow bounceInUp animated', 'caption' => false, 'posicao' => 2)); ?>
</div>

<section class="main-container col1-layout home-content-container">
	<div class="container">
		<div class="best-seller-pro wow bounceInUp animated">
		    <div class="slider-items-products">
		      	<div class="new_title center">
		        	<h2>Destaques</h2>
		      	</div>
		      	<div id="best-seller-slider" class="product-flexslider hidden-buttons">
					<?php echo $this->helper->produto->getHelper(array('quantidade_itens' => 20, 'container' => 'div', 'container_class' => 'slider-items slider-width-col4', 'produto_info_titulo' => '<div class="%1Ss"><a href="%2Ss">%3Ss</a></div>', 'item_wrap' => '<div class="%1Ss">%2Ss</div>', 'item_class' => 'item', 'thumbnail_wrap' => '<div class="product-block"><div class="%1Ss"><figure class="product-display">%2Ss</figure></div></div>', 'thumbnail_class' => 'product-image', 'info_titulo_wrap' => '<div class="%1Ss"><a href="%2Ss">%3Ss</a></div>', 'info_titulo_class' => 'item-title', 'info_preco_wrap' => '<div class="price-box"> <span class="%1Ss">R$ %2Ss</span></div>', 'info_preco_class' => 'price', 'info_wrap' => '<div class="item-info"><div class="%1Ss">%2Ss</div></div>', 'info_class' => 'info-inner', 'overlay_wrap' => '<div class="product-block"><div class="product-meta"><div class="%1Ss">%2Ss</div></div></div>', 'overlay_class' => 'product-action', 'destaque' => 1, 'produto_container' => false, 'overlay_options' => array('QUICK_VIEW' => array('text' => '<i class="fa fa-eye"></i> Preview', 'class' => 'addcart'), 'COMPARE' => array('text' => '<i class="fa fa-signal"></i> Compare', 'class' => 'addcart')))); ?>
		      	</div>  
			</div>
		</div>
	</div>
</section>

<section class="main-container col1-layout home-content-container">
	<div class="container">
		<div class="best-seller-pro wow bounceInUp animated">
		    <div class="slider-items-products">
		      <div class="new_title center">
		        <h2>Lancamentos</h2>
		      </div>
		      <div id="best-seller-slider" class="product-flexslider hidden-buttons">
			      	<?php echo $this->helper->produto->getHelper(array('destaque' => 0, 'lancamento' => 1)); ?>
		      </div>
		    </div>
		</div>
	</div>
</section>
