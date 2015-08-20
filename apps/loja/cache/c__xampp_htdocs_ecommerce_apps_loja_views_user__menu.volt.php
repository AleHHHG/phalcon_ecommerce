<div class="col-md-3 account-nav">
	<ul class="nav nav-stacked ">
  	  <li class="<?= ($this->dispatcher->getActionName() == 'index') ? 'active' : '' ?>"><?php echo $this->tag->linkTo(array('user', 'Minha Conta')); ?></li>
  	  <li class="<?= ($this->dispatcher->getActionName() == 'pedidos') ? 'active' : '' ?>"><?php echo $this->tag->linkTo(array('user/pedidos', 'Meus Pedidos')); ?></li>
	  <li class="<?= ($this->dispatcher->getActionName() == 'avaliacoes') ? 'active' : '' ?>"><?php echo $this->tag->linkTo(array('user/avaliacoes', 'Minhas Avaliações')); ?></li>
	  <li class="<?= ($this->dispatcher->getParam('param') == 'dados') ? 'active' : '' ?>"><?php echo $this->tag->linkTo(array('user/edit/dados', 'Editar Dados')); ?></li>
	  <li class="<?= ($this->dispatcher->getParam('param') == 'password') ? 'active' : '' ?>"><?php echo $this->tag->linkTo(array('user/edit/password', 'Alterar Senha')); ?></li>
	</ul>
</div>
