<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">Banners</h1>
      </div>
      <div class="pull-right hidden-xs">
         <ol class="breadcrumb">
            <li>
               <a href="index-2.html"><i class="fa fa-home"></i>Home</a>
            </li>
            <li class='active'>
               <a href="tables-basic.html">Banner</a>
            </li>
         </ol>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<div class="col-lg-12">
<section class="box ">
<header class="panel_header">
   <?php echo $this->tag->linkTo(array('admin/banner/create', 'Novo Banner', 'class' => 'btn btn-primary btn-lg pull-right')); ?>
   <br clear="all"/>
</header>
<div class="content-body">
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Local</th>
                  <th>Ordem</th>
                  <th>Opções</th>
               </tr>
            </thead>
            <tbody>
            <?php foreach ($banners as $banner) { ?>
               <tr>
                  <td>
                    <?php echo $banner->id; ?>
                  </td>
                  <td>
                    <?php echo $banner->nome; ?>
                  </td>
                  <td>
                    <?php echo $banner->posicao->nome; ?>
                  </td>
                  <td>
                    <?php echo $banner->ordem; ?>
                  </td>
                  <td class='text-center'>
                     <?php echo $this->tag->linkTo(array('admin/banner/update/' . $banner->id, '<i class="fa fa-pencil icon-square icon-default "></i>')); ?>

                     <?php echo $this->tag->linkTo(array('admin/banner/delete/' . $banner->id, '<i class="fa fa-times icon-square icon-danger "></i>')); ?>
                  </td>
               </tr>
            <?php } ?>
            </tbody>
         </table>
      </div>
   </div>
</div>