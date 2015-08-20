<div class="top_bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              {{ helper.topBar.getHelper([
                    'container_class': 'tb_center pull-left',
                    'actions':[
                      'fone','email','my_account'
                    ]
                ])
              }}
              </div>
         </div>
    </div>
</div>
<div class="container-fluid checkout">
	<div class="row">
		<div class="col-md-12">
		   	<a class="navbar-brand" href="{{url.getBaseUri()}}">
	      	<img src="{{url.getBaseUri()}}img/loja/smile/logo.png" class="img-responsive" alt="">
		    </a>
	  	</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-md-12">
			<br clear="all"/>
			<div class="text-center">
				{% if pedido.status_id == 3 %}
					<div class="text-success">
						<i class="fa fa-check-circle fa-5x"></i>
						<h3>Seu pagamento foi Autorizado</h3>
						<h5>Nossa equipe de logistica está preparando seu pedido para envio, acompanhe todos os detalhes de sua compra no seu <strong>E-mail</strong> e no link abaixo.</h5>
						<a href="#" class="btn btn-success">Minha Conta</a>
					</div>
				{% elseif pedido.status_id == 6 %}
					<div class="text-danger">
						<i class="fa fa-times-circle fa-5x"></i>
						<h3>Seu pagamento não  foi Autorizado</h3>
						<h5>Para realizar o pedido com uma nova forma de pagamento clique no botão abaixo.</h5>
						<br/>
						<a href="#" class="btn btn-danger">Nova forma de Pagamento</a>
					</div>
				{% else %}
					<div class="text-info">
						<i class="fa fa-info-circle fa-5x"></i>
						<h3>Aguardando Pagamento</h3>
						<h5>Seu pagamento está passando pelo processo de aprovação, você sera informado via E-mail de todos os detalhe de seu pedido.</h5>
						<br/>
						<a href="#" class="btn btn-info">Acompanhar pedido</a>
					</div>
				{% endif %}
			</div>
			<br clear="all"/>
			<br clear="all"/>
			<br clear="all"/>
			<div class="col-md-12 text-center">
				<h5>Agradecemos por escolher nossa loja!</h5>
			</div>
		</div>
	</div>
</div>