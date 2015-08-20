<!DOCTYPE html>
<html>
   <head>
      <?php echo $this->partial('layouts/_metas'); ?>
   </head>
   <!-- END HEAD -->
   <!-- BEGIN BODY -->
   <body>
      <?php echo $this->partial('layouts/_header'); ?>
      <!-- START CONTAINER -->
      <div class="page-container row-fluid">
         <!-- SIDEBAR - START -->
         <?php echo $this->partial('layouts/_menu'); ?>
         <!--  SIDEBAR - END -->
         <!-- START CONTENT -->
         <section id="main-content" class=" ">
            <section class="wrapper" style='margin-top:60px;display:inline-block;width:100%;padding:15px 0 0 15px;'>
               <?php echo $this->getContent(); ?>
            </section>
         </section>
      </div>
      <?php echo $this->partial('layouts/_scripts'); ?>
      <!-- modal end -->
   </body>
</html>