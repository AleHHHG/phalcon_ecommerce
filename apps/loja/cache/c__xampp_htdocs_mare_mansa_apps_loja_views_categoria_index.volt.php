<section class="main-container col2-left-layout">
    <div class="main container">
        <div class="row">
            <section class="col-main col-sm-9 col-sm-push-3 wow bounceInUp animated">
                <div class="category-title">
                    <h1><?php echo $nome; ?></h1>
                </div>
                <br clear="all"/>
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
