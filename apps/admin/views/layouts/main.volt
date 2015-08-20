<!DOCTYPE html>
<html>
   <head>
      {{ partial("layouts/_metas") }}
   </head>
   <!-- END HEAD -->
   <!-- BEGIN BODY -->
   <body>
      {{ partial("layouts/_header") }}
      <!-- START CONTAINER -->
      <div class="page-container row-fluid">
         <!-- SIDEBAR - START -->
         {{ partial("layouts/_menu") }}
         <!--  SIDEBAR - END -->
         <!-- START CONTENT -->
         <section id="main-content" class=" ">
            <section class="wrapper" style='margin-top:60px;display:inline-block;width:100%;padding:15px 0 0 15px;'>
               {{ content()}}
            </section>
         </section>
      </div>
      <!-- General section box modal start -->
      <div class="modal" id="section-settings" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
         <div class="modal-dialog animated bounceInDown">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Section Settings</h4>
               </div>
               <div class="modal-body">
                  Body goes here...
               </div>
               <div class="modal-footer">
                  <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                  <button class="btn btn-success" type="button">Save changes</button>
               </div>
            </div>
         </div>
      </div>
      {{ partial("layouts/_scripts") }}
      <!-- modal end -->
   </body>
</html>