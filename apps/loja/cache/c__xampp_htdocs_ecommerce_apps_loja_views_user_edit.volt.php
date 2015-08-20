<div class="bcrumbs">
    <div class="container">
        <ul>
            <li><a href="#">Home</a></li>
            <li>Minha Conta</li>
            <li>
            	<?php if ($param == 'password') { ?>
					Alterar Senha
				<?php } else { ?>
					Editar Dados
				<?php } ?>
			</li>
        </ul>
    </div>
</div>

<div class="container">
	<?php echo $this->partial('user/_menu'); ?>
	<div class="col-md-9">

		<?php echo $this->flashSession->output(); ?>

		<h4>
			<strong>
			<?php if ($param == 'password') { ?>
				Alterar Senha
			<?php } else { ?>
				Editar Dados
			<?php } ?>
			</strong>
		</h4>
		<br/>
		<?php echo $this->tag->form(array('user/edit/' . $this->dispatcher->getParam('param'), 'method' => 'post')); ?>
			<?php if ($param == 'password') { ?>
				<div class="form-group">
					<?php echo $this->tag->passwordField(array('senha_atual', 'class' => 'form-control', 'placeholder' => 'Senha Atual')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->tag->passwordField(array('senha', 'class' => 'form-control', 'placeholder' => 'Nova Senha')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->tag->passwordField(array('repeat_senha', 'class' => 'form-control', 'placeholder' => 'Repita a Nova Senha')); ?>
				</div>
			<?php } else { ?>

			<?php } ?>
			<?php echo $this->tag->submitButton(array('Editar Dados', 'class' => 'btn text-right btn-danger')); ?>
		<?php echo $this->tag->endform(); ?>
	</div>
</div>

<br clear="all"/>