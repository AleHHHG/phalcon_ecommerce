 <?php foreach ($form as $element) { ?>
 <div class="form-group">
     <?php echo $element->label(array('class' => 'form-label')); ?>
     <?php echo $element; ?>
 </div>
<?php } ?>
<?php echo $this->tag->submitButton(array('Salvar', 'class' => 'btn btn-primary btn-lg')); ?>