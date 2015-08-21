<div class="bcrumbs">
    <div class="container">
        <ul>
            <li><a href="<?php echo $this->url->getBaseUri(); ?>">Home</a></li>
            <li><a href="#">Comparação</a></li>
        </ul>
    </div>
</div>
<div class="container">
	<?php echo $this->helper->comparacao->getHelper(array('produtos' => $produtos)); ?>
</div>

<br clear="all"/>