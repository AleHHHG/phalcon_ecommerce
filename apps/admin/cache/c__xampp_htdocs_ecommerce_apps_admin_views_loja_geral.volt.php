<div class="col-lg-12">
   <section class="box ">
	   	<header class="panel_header">
	        <h2 class="title pull-left">Geral</h2>
	    </header>
         <div class="content-body">
			<?php echo $this->tag->form(array('admin/loja/geral')); ?>
				<?php foreach ($form as $element) { ?>
				   <div class="form-group">
				       <?php echo $element->label(array('class' => 'form-label')); ?>
				       <?php echo $element->setAttribute('class', 'form-control'); ?>
				   </div>
				<?php } ?>
			   	<?php echo $this->tag->submitButton(array('Editar', 'class' => 'btn btn-primary')); ?>
			<?php echo $this->tag->endform(); ?>
		</div>
	</section>
</div>