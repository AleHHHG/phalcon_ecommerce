<div class="col-md-3 account-nav">
	<ul class="nav nav-stacked ">
  	  <li class="<?= ($this->dispatcher->getActionName() == 'index') ? 'active' : '' ?>">{{ link_to('user','Minha Conta')}}</li>
  	  <li class="<?= ($this->dispatcher->getActionName() == 'pedidos') ? 'active' : '' ?>">{{ link_to('user/pedidos','Meus Pedidos')}}</li>
	  <li class="<?= ($this->dispatcher->getActionName() == 'avaliacoes') ? 'active' : '' ?>">{{ link_to('user/avaliacoes','Minhas Avaliações')}}</li>
	  <li class="<?= ($this->dispatcher->getParam('param') == 'dados') ? 'active' : '' ?>">{{ link_to('user/edit/dados','Editar Dados')}}</li>
	  <li class="<?= ($this->dispatcher->getParam('param') == 'password') ? 'active' : '' ?>">{{ link_to('user/edit/password','Alterar Senha')}}</li>
	</ul>
</div>
