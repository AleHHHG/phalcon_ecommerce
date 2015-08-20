<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">Nova Categoria</h1>
      </div>
      <div class="pull-right hidden-xs">
         <ol class="breadcrumb">
            <li>
               <a href="index-2.html"><i class="fa fa-home"></i>Home</a>
            </li>
            <li class='active'>
               <a href="tables-basic.html">Categorias</a>
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
            <?php echo $this->tag->form(array('admin/categoria/create', 'mehtod' => 'post')); ?>

               <?php foreach ($form as $element) { ?>
                 <div class="form-group">
                     <?php echo $element->label(array('class' => 'form-label')); ?>
                     <?php echo $element; ?>
                 </div>
               <?php } ?>

               <?php echo $this->tag->submitButton(array('Adicionar', 'class' => 'btn btn-primary')); ?>

            <?php echo $this->tag->endform(); ?>
         </div>
   </section>
</div>