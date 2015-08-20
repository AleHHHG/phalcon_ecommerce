<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <meta charset="utf-8" />
      <title>Ultra Admin : Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <meta content="" name="description" />
      <meta content="" name="author" />
      <!-- CORE CSS FRAMEWORK - START -->
      {{ stylesheet_link("plugin/admin/pace/pace-theme-flash.css") }}

      {{ stylesheet_link("plugin/admin/bootstrap/css/bootstrap.min.css") }}

      {{ stylesheet_link("plugin/admin/bootstrap/css/bootstrap-theme.min.css") }}

      {{ stylesheet_link("plugin/admin/bootstrap/css/bootstrap.min.css") }}

      {{ stylesheet_link("css/admin/animate.min.css") }}

      {{ stylesheet_link("plugin/admin/perfect-scrollbar/perfect-scrollbar.css") }}

      {{ stylesheet_link("plugin/admin/icheck/skins/square/orange.css") }}

      {{ stylesheet_link("css/admin/style.css") }}

      {{ stylesheet_link("css/admin/responsive.css") }}
     
   </head>
   <!-- END HEAD -->
   <!-- BEGIN BODY -->
   <body class=" login_page">
      <div class="login-wrapper">
         <div id="login" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-2 col-xs-8">
            <form name="loginform" id="loginform" action="" method="post">
               <p>
                  <label for="user_login">E-mail<br />
                  <input type="text" name="email" id="user_login" class="input" /></label>
               </p>
               <p>
                  <label for="user_pass">Senha<br />
                  <input type="password" name="password" id="user_pass" class="input"/></label>
               </p>
               <p class="forgetmenot">
                  <label class="icheck-label form-label" for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" class="skin-square-orange"> Permanecer logado</label>
               </p>
               <p class="submit">
                  <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-orange btn-block" value="Entrar" />
               </p>
            </form>
            <p id="nav">
               <a class="pull-left" href="#" title="Password Lost and Found">Esqueceu a senha?</a>
            </p>
         </div>
      </div>


      {{ javascript_include('js/admin/jquery-1.11.2.min.js') }}

      {{ javascript_include('js/admin/jquery.easing.min.js') }}

      {{ javascript_include('plugin/admin/bootstrap/js/bootstrap.min.js') }}

      {{ javascript_include('plugin/admin/pace/pace.min.js') }}

      {{ javascript_include('plugin/admin/perfect-scrollbar/perfect-scrollbar.min.js') }}

      {{ javascript_include('plugin/admin/viewport/viewportchecker.js') }}

      {{ javascript_include('plugin/admin/icheck/icheck.min.js') }}
      
      {{ javascript_include('js/admin/scripts.js') }}

      {{ javascript_include('plugin/admin/sparkline-chart/jquery.sparkline.min.js') }}

      {{ javascript_include('js/admin/chart-sparkline.js') }}
      

   </body>

</html>