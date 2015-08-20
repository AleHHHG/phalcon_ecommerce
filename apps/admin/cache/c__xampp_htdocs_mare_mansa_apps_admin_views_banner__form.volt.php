<?php foreach ($form as $element) { ?>
   <div class="form-group">
       <?php echo $element->label(array('class' => 'form-label')); ?>
       <?php echo $element->setAttribute('class', 'form-control'); ?>
   </div>
<?php } ?>
<?php if ($this->dispatcher->getActionName() == 'update') { ?>
		<?php foreach ($imagens as $imagem) { ?>
			<div class="col-md-3">
				<?php echo $this->tag->image(array('files/banners/' . $imagem->url, 'class' => 'img-responsive')); ?>
				<a href='#' class='btn btn-orange'><i class='fa fa-times'></i></a>
			</div>
		<?php } ?>
<?php } ?>
<br clear='all' />
<?php if ($this->dispatcher->getActionName() == 'create') { ?>
	<?php echo $this->tag->submitButton(array('Adicionar', 'class' => 'pull-right  btn-lg btn btn-primary')); ?>
<?php } else { ?>
 	<?php echo $this->tag->submitButton(array('Editar', 'class' => 'pull-right  btn-lg btn btn-danger')); ?>
<?php } ?>
<br clear='all'/>