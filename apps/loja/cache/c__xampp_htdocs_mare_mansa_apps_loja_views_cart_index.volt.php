<div class="bcrumbs">
    <div class="container">
        <ul>
            <li><a href="<?php echo $this->url->getBaseUri(); ?>">Home</a></li>
            <li><a href="#">Carrinho</a></li>
        </ul>
    </div>
</div>
<div class="shop-single">
    <div class="container">
        <div class="row">
        	<div class="col-md-12">
        		<?php echo $this->helper->cart->getHelper(array('size' => 'col-md-7', 'container_class' => 'cart-table', 'layout' => 'CART_LAYOUT')); ?>
                
                <!-- Fazer um helper -->
                <div class="col-md-4 pull-right">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <h4>Calcular Frete:</h4>
                                    <div class="row">
                                        <div class="col-md-6 no-padding-right">
                                             <input type="text" class="form-control frete-calcular" value="<?php echo $this->session->get('cep'); ?>" />
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-primary frete-calcular-btn">Calcular</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr id="frete-opcoes" style="display:none">
                                <td></td>
                            </tr>
                            <tr>
                                <td><h5>SubTotal: <strong>R$ <span id="cart-subtotal"><?php echo $subtotal; ?></span> </strong></h5></td>
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
                                <td><h5>Total: <strong>R$ <span id="cart-total"><?php echo $total; ?></span> </strong></h5></td>
                            </tr>
                            <tr>
                                <td class="">
                                    <button class="btn btn-black">Continuar Comprando</button>
                                    <button class="btn btn-color">Finalizar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        	</div>
        </div>
    </div>
</div>
<br clear="all"/>