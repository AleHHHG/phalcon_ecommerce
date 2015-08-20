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
		<h4><strong>Meus pedidos</strong></h4>
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
	</div>
</div>

<br clear="all"/>