<div class="bcrumbs">
    <div class="container">
        <ul>
            <li><a href="#">Home</a></li>
            <li>Minha Conta</li>
            <li>
            	{% if param == 'password' %}
					Alterar Senha
				{% else %}
					Editar Dados
				{% endif %}
			</li>
        </ul>
    </div>
</div>

<div class="container">
	{{ partial('user/_menu')}}
	<div class="col-md-9">

		{{ flashSession.output() }}

		<h4>
			<strong>
			{% if param == 'password' %}
				Alterar Senha
			{% else %}
				Editar Dados
			{% endif %}
			</strong>
		</h4>
		<br/>
		{{ form("user/edit/"~dispatcher.getParam('param'), 'method': 'post') }}
			{% if param == 'password' %}
				<div class="form-group">
					{{ password_field('senha_atual', 'class': 'form-control','placeholder':'Senha Atual') }}
				</div>
				<div class="form-group">
					{{ password_field('senha', 'class': 'form-control','placeholder':'Nova Senha') }}
				</div>
				<div class="form-group">
					{{ password_field('repeat_senha', 'class': 'form-control','placeholder':'Repita a Nova Senha') }}
				</div>
			{% else %}

			{% endif %}
			{{ submit_button('Editar Dados','class':'btn text-right btn-danger') }}
		{{ endForm() }}
	</div>
</div>

<br clear="all"/>