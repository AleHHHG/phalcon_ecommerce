<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">Editar Produto</h1>
      </div>
      <div class="pull-right hidden-xs">
         <ol class="breadcrumb">
            <li>
               <a href="index-2.html"><i class="fa fa-home"></i>Home</a>
            </li>
            <li class='active'>
               <a href="tables-basic.html">Produtos</a>
            </li>
         </ol>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<p><?= $this->flashSession->output() ?></p>
<div class="col-lg-12">
   <section>
         <?php echo $this->tag->form(array('admin/produto/update/' . $produto->_id, 'enctype' => 'multipart/form-data')); ?>
            <?php echo $this->partial('produto/_form', array('acao' => 'update')); ?>
         <?php echo $this->tag->endform(); ?>
   </section>
</div>