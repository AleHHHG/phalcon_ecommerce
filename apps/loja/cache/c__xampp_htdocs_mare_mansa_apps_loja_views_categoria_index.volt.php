<section class="main-container col2-left-layout">
    <div class="main container">
        <div class="row">
            <section class="col-main col-sm-9 col-sm-push-3 wow bounceInUp animated">
                <div class="category-title">
                    <h1><?php echo $nome; ?></h1>
                </div>
                <div class="category-description std">
                    <div class="slider-items-products">
                        <div id="category-desc-slider" class="product-flexslider hidden-buttons">
                            <div class="slider-items slider-width-col1"> 
                              
                              <!-- Item -->
                              <div class="item"> <a href="#x"><img alt="" src="<?php echo $this->ecommerce_options->image_path; ?>women_banner.png"></a> </div>
                              <!-- End Item --> 
                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="category-products">
                    <?php echo $this->partial('categoria/_produtos'); ?>
                </div>
            </section>
            <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9 wow bounceInUp animated">
                 <?php echo $this->partial('template/_sidebar'); ?>
            </aside>
        </div>
    </div>
</section>
