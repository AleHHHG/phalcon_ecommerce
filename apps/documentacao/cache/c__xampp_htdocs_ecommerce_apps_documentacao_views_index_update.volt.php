<div class="col-lg-12">
   	<div class="page-title">
        <div class="pull-left">
            <h1 class="title">Editar <?php echo $doc->nome; ?></h1>
        </div>
        <div class="pull-right hidden-xs">
            <ol class="breadcrumb">
                <li>
                	<?php echo $this->tag->linkTo(array('/documentacao', '<i class="fa fa-home"></i>Home')); ?>
                </li>
                <li class="active">
                    <strong>Editar</strong>
                </li>
            </ol>
        </div>
    </div>
   <section class="box">
   		<div class="content-body">
			<?php echo $this->tag->form(array('documentacao/update/' . $doc->id)); ?>
				<?php echo $this->partial('index/_form'); ?>
			<?php echo $this->tag->endform(); ?>
		</div>
   </section>
</div>