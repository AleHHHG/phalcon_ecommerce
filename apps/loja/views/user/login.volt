<div class="bcrumbs">
    <div class="container">
        <ul>
            <li><a href="#">Home</a></li>
            <li>Login</li>
        </ul>
    </div>
</div>

<div class="container">
	{{ flashSession.output() }}
	<!-- Login -->
	<div class="col-md-5 text-center col-xs-12 box-login">
		{{ form('user/login', 'method': 'post') }}
			<h3>Login</h3>
			<div class="clearfix"></div>
			{{ link_to('#','<i class="fa fa-facebook-official"></i> Facebook','class':'btn btn-primary btn-100 btn-facebook')}}
			<hr/>
			<div class="form-group">
				{{ text_field('email', 'class': 'form-control','placeholder':'E-mail') }}
			</div>
			<div class="form-group">
				{{ password_field('senha', 'class': 'form-control','placeholder':'Senha') }}
			</div>
			{{ submit_button('Entrar','class':'btn text-right btn-primary') }}
			<hr/>
			{{ link_to('#','Esqueci minha senha')}}
		{{ end_form() }}
	</div>
	<!-- Divisor -->
	<div class="col-md-1 login-divisor hidden-xs hidden-sm"></div>

	<div class="col-md-5 text-center col-xs-12 box-login pull-right">
		{{ form('user/create', 'method': 'post') }}
			<h3>Cadastre-se</h3>
			<div class="clearfix"></div>
			{{ link_to('#','<i class="fa fa-facebook-official"></i> Facebook','class':'btn btn-primary btn-100 btn-facebook')}}
			<hr/>
			<div class="form-group">
				{{ text_field('email', 'class': 'form-control','placeholder':'E-mail') }}
			</div>
			<div class="form-group">
				{{ password_field('senha', 'class': 'form-control','placeholder':'Senha') }}
			</div>
			<div class="form-group">
				{{ password_field('senha-confirmacao', 'class': 'form-control','placeholder':'Repita a Senha') }}
			</div>
			{{ submit_button('Cadastrar','class':'btn btn-primary') }}
		{{ end_form() }}
	</div>
</div>

<br clear="all"/>
<br clear="all"/>
