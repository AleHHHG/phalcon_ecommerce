<div class="top_bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              {{ helper.topBar.getHelper([
                    'container_class': 'tb_center pull-left',
                    'actions':[
                      'fone','email'
                    ]
                ])
              }}
              </div>
         </div>
    </div>
</div>
<div class="container-fluid checkout">
	<div class="row">
		<div class="col-md-12">
		   	<a class="navbar-brand" href="{{url.getBaseUri()}}">
	      	<img src="{{url.getBaseUri()}}img/loja/smile/logo.png" class="img-responsive" alt="">
		    </a>
	  	</div>
	</div>
	<hr/>
	<div class="row">
		{{ form("checkout/finalizar", "method": "post") }}
			<div class="col-md-4">
				<h4><span class="checkout-seletor">1</span>Endereço de entrega</h4>
				<div class="form-group">
					<input type="text" name="endereco[cep]" class='form-control frete-calcular' placeholder="CEP" value={{ session.get('cep')}} required/>
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
				{% for pagamentos in widgets %}
				<div class="radio">
				  <label>
				    <input type="radio" class="checkout-forma-pagamento" name="forma_pagamento" value="{{pagamentos['id']}}" required>
				    {{pagamentos['nome']}}
				  </label>
				  {% if pagamentos['form'] is defined %}
					  <div class="ckeckout-form" style="display:none">
					  	{% for element in pagamentos['form'] %}
			             <div class="form-group">
			                 {{ element}}
			             </div>
			          {% endfor %}
					  </div>
					{% endif %}
				</div>
				{% endfor %}
		  	</div>
		  	<div class="col-md-4 checkout-resumo">
		  		{{ helper.cart.getHelper([
	    				'size': 'col-md-12',
	              		'container_class': 'table',
	              		'layout': 'CART_LAYOUT',
	              		'thead': false,
	              		'resumo': true
	                ])
	     		}}
	     		<table class="table">
	     			<tr>
	     				<td>
	     					<h5>Subtotal: 
	     						<strong>R$
		     						<span id="cart-subtotal">
		     							{{ subtotal }}
		     						</span>
		     					</strong>
	     					</h5>
	     				</td>
	     			</tr>
	     			<tr {% if frete is not defined%}style="display:none"{% endif %}>
                        <td>
                            <h5>Frete: 
                                <strong>R$
                                    <span id="cart-frete">
                                        {% if frete is defined%}
                                            {{ frete }}
                                        {% endif %}
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
		     							{{ total }}
		     						</span>
		     					</strong>
	     					</h5>
	     				</td>
	     			</tr>
	     		</table>
	     		<button type="submit" class="checkout-finalizar btn">Finalizar Compra</button>
		  	</div>
	  	{{ endform() }}
	</div>
</div>