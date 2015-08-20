<!-- TOPBAR -->
<div class="top_bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <?php echo $this->helper->topBar->getHelper(array('container_class' => 'tb_center pull-left', 'actions' => array('fone', 'email', 'my_account', 'to_cart', 'compare', 'login'))); ?>
              </div>
         </div>
    </div>
</div>
<div id="undefined-sticky-wrapper" class="sticky-wrapper" style="height: 140px;">
  <header>
    <nav class="navbar navbar-default">
      <div class='container'>
          <div class="header-xtra pull-right">
            <div class="topcart">
                <span><i class="fa fa-shopping-cart"></i></span>
                <div class="cart-header-container">
                  <?php echo $this->helper->cart->getHelper(array('layout' => 'HEADER_CART_LAYOUT', 'container_class' => 'cart-info', 'item_container_class' => 'ci-item', 'thumbnail_container' => '', 'thumbnail_width' => 80, 'info_container_class' => 'ci-item-info', 'info_title_wrap' => '<h5><a href="%1Ss" class="%2Ss">%3Ss</a></h5>', 'info_price_class' => 'pull-left', 'remove_link_class' => 'btn btn-default pull-right', 'subtotal_class' => 'ci-total', 'buttons_class' => 'cart-btn')); ?>
                </div>
            </div>
        </div>
        <a class="navbar-brand" href="<?php echo $this->url->getBaseUri(); ?>">
          <img src="<?php echo $this->url->getBaseUri(); ?>img/loja/smile/logo.png" class="img-responsive" alt="">
        </a>
	      <?php echo $this->helper->menu->getHelper(array('container_class' => 'collapse navbar-collapse', 'container_id' => 'bs-example-navbar-collapse-1', 'menu_class' => 'nav navbar-nav navbar-right', 'item_class' => 'dropdown', 'item_link_class' => 'dropdown-toggle', 'submenu_class' => 'dropdown-menu submenu')); ?>
      </div>
    </nav>
  </header>
</div>