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
                <?php echo $this->partial('categoria/_produtos'); ?>
            </div>
        </div>
    </div>
</div>