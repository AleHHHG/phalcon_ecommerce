<?php echo $this->tag->javascriptInclude('js/jquery-1.11.3.min.js'); ?>
<?php echo $this->tag->javascriptInclude('js/bootstrap.min.js'); ?>
<?php foreach ($js as $arquivo) { ?>
	<?php echo $this->tag->javascriptInclude($arquivo); ?>
<?php } ?>
<?php echo $this->tag->javascriptInclude('js/loja/jquery-ias.min.js'); ?>
<?php echo $this->tag->javascriptInclude('js/loja/toastr.js'); ?>
<?php echo $this->tag->javascriptInclude('js/loja/cart.js'); ?>
<?php echo $this->tag->javascriptInclude('js/loja/frete.js'); ?>
<?php echo $this->tag->javascriptInclude('js/loja/checkout.js'); ?>
<?php echo $this->tag->javascriptInclude('js/loja/filtros.js'); ?>
<?php echo $this->tag->javascriptInclude('js/loja/options.js'); ?>
<?php echo $this->tag->javascriptInclude('js/loja/endereco.js'); ?>
