<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <meta charset="utf-8" />
      <title>Ecommerce Admin : Login </title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <meta content="Login Ecommerce by Webearte 2.0" name="description" />
      <meta content="Webearte | Alessandro" name="author" />

      {{ stylesheet_link("plugin/admin/bootstrap/css/bootstrap.min.css") }}

      {{ stylesheet_link("plugin/admin/bootstrap/css/bootstrap-theme.min.css") }}

      {{ stylesheet_link("css/admin/style.css") }}

      {{ stylesheet_link("css/admin/responsive.css") }}
     
   </head>
   <!-- END HEAD -->
   <!-- BEGIN BODY -->
   <body class=" login_page">
      <div class="login-wrapper">
        {{ content()}}
      </div>


      {{ javascript_include('js/admin/jquery-1.11.2.min.js') }}


      {{ javascript_include('plugin/admin/bootstrap/js/bootstrap.min.js') }}


      {{ javascript_include('plugin/admin/viewport/viewportchecker.js') }}

      
      {{ javascript_include('js/admin/scripts.js') }}

      <script type="text/javascript">
            $('.successMessage').addClass('alert alert-success');
            $('.errorMessage').addClass('alert alert-danger');
            $('.noticeMessage').addClass('alert alert-info');
            $('.warningMessage').addClass('alert alert-warning')
      </script>
      

   </body>

</html>