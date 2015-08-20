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
				<?php foreach ($pedidos as $pedido) { ?>
				<tr>
					<td><?php echo $pedido->pedidoStatus->nome; ?></td>
					<td><?php echo $pedido->widgets->nome; ?></td>
					<td><?php echo $pedido->freteTipos->nome; ?> - R$ <?php echo $pedido->frete; ?></td>
					<td>R$ <?php echo $pedido->total; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<br clear="all"/>