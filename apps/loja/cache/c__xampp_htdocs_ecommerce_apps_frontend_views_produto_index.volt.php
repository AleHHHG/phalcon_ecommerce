<h1><?php echo $titulo; ?></h1>
<?php foreach ($produtos as $produto) { ?>
	<?php echo $produto->nome; ?> <br/>
<?php } ?>