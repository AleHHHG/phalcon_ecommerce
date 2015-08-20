<div class="bcrumbs">
    <div class="container">
        <ul>
            <li><a href="#">Home</a></li>
            <li>Login</li>
        </ul>
    </div>
</div>

<div class="container">
	<?php echo $this->flashSession->output(); ?>
	<!-- Login -->
	<div class="col-md-5 text-center col-xs-12 box-login">
		<?php echo $this->tag->form(array('user/login', 'method' => 'post')); ?>
			<h3>Login</h3>
			<div class="clearfix"></div>
			<?php echo $this->tag->linkTo(array('#', '<i class="fa fa-facebook-official"></i> Facebook', 'class' => 'btn btn-primary btn-100 btn-facebook')); ?>
			<hr/>
			<div class="form-group">
				<?php echo $this->tag->textField(array('email', 'class' => 'form-control', 'placeholder' => 'E-mail')); ?>
			</div>
			<div class="form-group">
				<?php echo $this->tag->passwordField(array('senha', 'class' => 'form-control', 'placeholder' => 'Senha')); ?>
			</div>
			<?php echo $this->tag->submitButton(array('Entrar', 'class' => 'btn text-right btn-primary')); ?>
			<hr/>
			<?php echo $this->tag->linkTo(array('#', 'Esqueci minha senha')); ?>
		<?php echo $this->tag->endForm(); ?>
	</div>
	<!-- Divisor -->
	<div class="col-md-1 login-divisor hidden-xs hidden-sm"></div>

	<div class="col-md-5 text-center col-xs-12 box-login pull-right">
		<?php echo $this->tag->form(array('user/create', 'method' => 'post')); ?>
			<h3>Cadastre-se</h3>
			<div class="clearfix"></div>
			<?php echo $this->tag->linkTo(array('#', '<i class="fa fa-facebook-official"></i> Facebook', 'class' => 'btn btn-primary btn-100 btn-facebook')); ?>
			<hr/>
			<div class="form-group">
				<?php echo $this->tag->textField(array('email', 'class' => 'form-control', 'placeholder' => 'E-mail')); ?>
			</div>
			<div class="form-group">
				<?php echo $this->tag->passwordField(array('senha', 'class' => 'form-control', 'placeholder' => 'Senha')); ?>
			</div>
			<div class="form-group">
				<?php echo $this->tag->passwordField(array('senha-confirmacao', 'class' => 'form-control', 'placeholder' => 'Repita a Senha')); ?>
			</div>
			<?php echo $this->tag->submitButton(array('Cadastrar', 'class' => 'btn btn-primary')); ?>
		<?php echo $this->tag->endForm(); ?>
	</div>
</div>

<br clear="all"/>
<br clear="all"/>
