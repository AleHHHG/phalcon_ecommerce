<div id="login" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-2 col-xs-8">
   {{form('admin/login','id':'loginform')}}
      <form name="loginform" id="loginform" action="" method="post">
         <p>
            <?php $this->flashSession->output() ?>
         </p>
         <p>
            <label for="user_login">E-mail<br />
            <input type="text" name="email" id="user_login" class="input" /></label>
         </p>
         <p>
            <label for="user_pass">Senha<br />
            <input type="password" name="password" id="user_pass" class="input"/></label>
         </p>
         <p class="submit">
            <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-orange btn-block" value="Entrar" />
         </p>
      </form>
      <p id="nav">
         <a class="pull-left" href="#">Esqueceu a senha?</a>
      </p>
   {{ end_form() }}
   <br clear="all"/>
   <hr/>
   <div class="col-md-6 pull-right">
      {{image('img/loja/webearte_white.png','class':'img-responsive')}}
   </div>
</div>