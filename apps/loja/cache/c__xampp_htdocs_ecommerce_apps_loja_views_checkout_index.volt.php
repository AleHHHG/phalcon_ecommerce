<div class="top_bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <?php echo $this->helper->topBar->getHelper(array('container_class' => 'tb_center pull-left', 'actions' => array('fone', 'email'))); ?>
              </div>
         </div>
    </div>
</div>
<div class="container-fluid checkout">
	<div class="row">
		<div class="col-md-12">
		   	<a class="navbar-brand" href="<?php echo $this->url->getBaseUri(); ?>">
	      	<img src="<?php echo $this->url->getBaseUri(); ?>img/loja/smile/logo.png" class="img-responsive" alt="">
		    </a>
	  	</div>
	</div>
	<hr/>
	<div class="row">
		<?php echo $this->tag->form(array('checkout/finalizar', 'method' => 'post')); ?>
			<div class="col-md-4">
				<h4><span class="checkout-seletor">1</span>Endereço de entrega</h4>
				<div class="form-group">
					<input type="text" name="endereco[cep]" class='form-control frete-calcular' placeholder="CEP" value=<?php echo $this->session->get('cep'); ?> required/>
				</div>
				<div class="form-group">
					<input type="text" name="endereco[estado]" class='form-control endereco-estado' placeholder="Estado" readonly required/>
				</div>
				<div class="form-group">
					<input type="text" name="endereco[cidade]" class='form-control endereco-cidade' placeholder="Cidade" readonly required/>
				</div>
				<div class="form-group">
					<input type="text" name='endereco[logradouro]' class='form-control endereco-logradouro' placeholder="Logradouro" required/>
				</div>
				<div class="form-group">
					<input type="text" name="endereco[bairro]" class='form-control endereco-bairro' placeholder="Bairro" required/>
				</div>
				<div class="form-group">
					<input type="text" name='endereco[numero]' class='form-control' placeholder="Numero" required />
				</div>
				<div class="form-group">
					<input type="text" name='endereco[complemento]' class='form-control' placeholder="Complemento" />
				</div>
		  	</div>
		  	<div class="col-md-4 checkout-divisor">
				<h4><span class="checkout-seletor">2</span>Metódo de entrega</h4>
				<table class="table">
					<tr id="frete-opcoes" style="display:none">
		                <td></td>
		            </tr>
	            </table>
	            <h4>
					<span class="checkout-seletor">3</span>Forma de pagamento
				</h4>
				<?php foreach ($widgets as $pagamentos) { ?>
				<div class="radio">
				  <label>
				    <input type="radio" class="checkout-forma-pagamento" name="forma_pagamento" value="<?php echo $pagamentos['id']; ?>" required>
				    <?php echo $pagamentos['nome']; ?>
				  </label>
				  <?php if (isset($pagamentos['form'])) { ?>
					  <div class="ckeckout-form" style="display:none">
					  	<?php foreach ($pagamentos['form'] as $element) { ?>
			             <div class="form-group">
			                 <?php echo $element; ?>
			             </div>
			          <?php } ?>
					  </div>
					<?php } ?>
				</div>
				<?php } ?>
		  	</div>
		  	<div class="col-md-4 checkout-resumo">
		  		<?php echo $this->helper->cart->getHelper(array('size' => 'col-md-12', 'container_class' => 'table', 'layout' => 'CART_LAYOUT', 'thead' => false, 'resumo' => true)); ?>
	     		<table class="table">
	     			<tr>
	     				<td>
	     					<h5>Subtotal: 
	     						<strong>R$
		     						<span id="cart-subtotal">
		     							<?php echo $subtotal; ?>
		     						</span>
		     					</strong>
	     					</h5>
	     				</td>
	     			</tr>
	     			<tr <?php if (!isset($frete)) { ?>style="display:none"<?php } ?>>
                        <td>
                            <h5>Frete: 
                                <strong>R$
                                    <span id="cart-frete">
                                        <?php if (isset($frete)) { ?>
                                            <?php echo $frete; ?>
                                        <?php } ?>
                                    </span>
                                </strong>
                            </h5>
                        </td>
                    </tr>
	     			<tr class="active">
	     				<td>
	     					<h5>Total: 
	     						<strong>R$
		     						<span id="cart-total">
		     							<?php echo $total; ?>
		     						</span>
		     					</strong>
	     					</h5>
	     				</td>
	     			</tr>
	     		</table>
	     		<button type="submit" class="checkout-finalizar btn">Finalizar Compra</button>
		  	</div>
	  	<?php echo $this->tag->endform(); ?>
	</div>
</div>