<div class="bcrumbs">
    <div class="container">
        <ul>
            <li><a href="#">Home</a></li>
            <li>Minha Conta</li>
        </ul>
    </div>
</div>

<div class="container">
	{{ partial('user/_menu')}}
	<div class="col-md-9">
		<h4><strong>Ultimos pedidos</strong></h4>
		<br/>
		<table class="table">
			<thead>
				<tr>
					<th>Status</th>
					<th>Forma Pagamento</th>
					<th>Frete</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				{% for pedido in pedidos%}
				<tr>
					<td>{{pedido.pedidoStatus.nome}}</td>
					<td>{{pedido.widgets.nome}}</td>
					<td>{{pedido.freteTipos.nome}} - R$ {{ pedido.frete}}</td>
					<td>R$ {{pedido.total}}</td>
				</tr>
				{% endfor %}
			</tbody>
		</table>

		<hr/>

		<h4><strong>Ultimas Avaliações</strong></h4>
		<br/>
		<table class="table">
			<thead>
				<tr>
					<th>Produto</th>
					<th>Descrição</th>
					<th style="width:15%">Nota</th>
					<th>Data</th>
				</tr>
			</thead>
			<tbody>
				{% for avaliacao in avaliacoes%}
				<tr>
					<td>{{avaliacao['produto']['nome']}}</td>
					<td>{{avaliacao['descricao']}}</td>
					<td>{{avaliacao['nota']}}</td>
					<td>{{avaliacao['data']}}</td>
				</tr>
				{% endfor %}
			</tbody>
		</table>
	</div>
</div>

<br clear="all"/>