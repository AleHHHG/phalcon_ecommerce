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
      {{ partial("layouts/_scripts") }}
      <!-- modal end -->
   </body>
</html>