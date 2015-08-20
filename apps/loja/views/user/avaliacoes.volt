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
		<h4><strong>Avaliações</strong></h4>
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