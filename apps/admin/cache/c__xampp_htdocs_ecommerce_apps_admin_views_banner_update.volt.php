<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">Editar Banner</h1>
      </div>
      <div class="pull-right hidden-xs">
         <ol class="breadcrumb">
            <li>
               <a href="index-2.html"><i class="fa fa-home"></i>Home</a>
            </li>
            <li class='active'>
               <a href="tables-basic.html">Editar Banner</a>
            </li>
         </ol>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<p><?= $this->flashSession->output() ?></p>
<div class="col-lg-12">
   <section class="box ">
         <div class="content-body">
            <?php echo $this->tag->form(array('admin/banner/update/' . $banner->id, 'enctype' => 'multipart/form-data')); ?>
              <?php echo $this->partial('banner/_form'); ?>
            <?php echo $this->tag->endform(); ?>
         </div>
   </section>
</div>