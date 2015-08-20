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
      <?php echo $this->tag->stylesheetLink('plugin/admin/pace/pace-theme-flash.css'); ?>

      <?php echo $this->tag->stylesheetLink('plugin/admin/bootstrap/css/bootstrap.min.css'); ?>

      <?php echo $this->tag->stylesheetLink('plugin/admin/bootstrap/css/bootstrap-theme.min.css'); ?>

      <?php echo $this->tag->stylesheetLink('plugin/admin/bootstrap/css/bootstrap.min.css'); ?>

      <?php echo $this->tag->stylesheetLink('css/admin/animate.min.css'); ?>

      <?php echo $this->tag->stylesheetLink('plugin/admin/perfect-scrollbar/perfect-scrollbar.css'); ?>

      <?php echo $this->tag->stylesheetLink('plugin/admin/icheck/skins/square/orange.css'); ?>

      <?php echo $this->tag->stylesheetLink('css/admin/style.css'); ?>

      <?php echo $this->tag->stylesheetLink('css/admin/responsive.css'); ?>
     
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


      <?php echo $this->tag->javascriptInclude('js/admin/jquery-1.11.2.min.js'); ?>

      <?php echo $this->tag->javascriptInclude('js/admin/jquery.easing.min.js'); ?>

      <?php echo $this->tag->javascriptInclude('plugin/admin/bootstrap/js/bootstrap.min.js'); ?>

      <?php echo $this->tag->javascriptInclude('plugin/admin/pace/pace.min.js'); ?>

      <?php echo $this->tag->javascriptInclude('plugin/admin/perfect-scrollbar/perfect-scrollbar.min.js'); ?>

      <?php echo $this->tag->javascriptInclude('plugin/admin/viewport/viewportchecker.js'); ?>

      <?php echo $this->tag->javascriptInclude('plugin/admin/icheck/icheck.min.js'); ?>
      
      <?php echo $this->tag->javascriptInclude('js/admin/scripts.js'); ?>

      <?php echo $this->tag->javascriptInclude('plugin/admin/sparkline-chart/jquery.sparkline.min.js'); ?>

      <?php echo $this->tag->javascriptInclude('js/admin/chart-sparkline.js'); ?>
      

   </body>

</html>