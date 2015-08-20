<?php echo $this->tag->form(array('admin/categoria/create', 'method' => 'post')); ?>
	<div class="form-group">
		<label>Nome</label>
		<?php echo $this->tag->textField(array('nome', 'class' => 'form-control')); ?>
	</div>
	 <?php echo $this->tag->submitButton(array('Salvar', 'class' => 'btn btn-primary')); ?>
<?php echo $this->tag->endForm(); ?>