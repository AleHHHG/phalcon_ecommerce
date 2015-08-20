<div class="bcrumbs">
    <div class="container">
        <ul>
            <li><a href="#">Home</a></li>
            <li>Minha Conta</li>
        </ul>
    </div>
</div>

<div class="container">
	<?php echo $this->partial('user/_menu'); ?>
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
				<?php foreach ($avaliacoes as $avaliacao) { ?>
				<tr>
					<td><?php echo $avaliacao['produto']['nome']; ?></td>
					<td><?php echo $avaliacao['descricao']; ?></td>
					<td><?php echo $avaliacao['nota']; ?></td>
					<td><?php echo $avaliacao['data']; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<br clear="all"/>