<div class="col-lg-12">
   	<div class="page-title">
        <div class="pull-left">
          <h1 class="title"><?php echo $doc->nome; ?> <small><?php echo $this->tag->linkTo(array('/documentacao/update/' . $doc->id, ' <i class="fa fa-edit"></i>')); ?></small></h1>
        </div>
        <div class="pull-right hidden-xs">
            <ol class="breadcrumb">
                <li>
                	<?php echo $this->tag->linkTo(array('/documentacao', '<i class="fa fa-home"></i>Home')); ?>
                </li>
                <li class="active">
                    <strong><?php echo $doc->nome; ?></strong>
                </li>
            </ol>
        </div>
    </div>
   <section class="box">
   	  <div class="content-body">
        <?php if (!empty($childrens)) { ?>
			   <div class="col-md-3">
            <div class="list-group">
              <?php foreach ($childrens as $item) { ?>
                <?php echo $this->tag->linkTo(array('/documentacao/show/' . $item['id'], $item['nome'], 'class' => 'list-group-item')); ?>
              <?php } ?>
            </div>
         </div>
         <div class="col-md-9">
            <?php echo $doc->conteudo; ?>
         </div>
         <?php } else { ?>
          <div class='col-md-12'>
            <?php echo $doc->conteudo; ?>
          </div>
         <?php } ?>
         <br clear="all"/>
		  </div>
      <br clear="all"/>
   </section>
</div>