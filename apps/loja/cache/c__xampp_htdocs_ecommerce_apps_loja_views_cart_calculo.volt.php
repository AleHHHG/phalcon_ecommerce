<table class="table frete-opcoes">
	<thead>
		<tr>
			<th>Tipo</th>
			<th>Valor</th>
			<th>Prazo</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($calculo as $key => $value) { ?>
			<?php if($value->Valor != '0,00'){ ?>
				<tr>
					<td style="text-align:left">
						<input type="radio" class="frete-tipo" data-valor="<?= $value->Valor ?>" name="tipo_frete" value="<?= $value->Codigo ?>" <?= ($value->Codigo == $this->session->get('frete')['codigo']) ? 'checked' : '' ?> required/>
						<?= $tipos["{$value->Codigo}"] ?>
					</td>
					<td>R$ <?= $value->Valor ?></td>
					<td><?= $value->PrazoEntrega ?> dias</td>
				</tr>
			<?php } ?>
		<?php } ?>
	</tbody>
</table>
