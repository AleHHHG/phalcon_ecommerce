<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">Pedido Detalhes</h1>
      </div>
      <div class="pull-right hidden-xs">
         <ol class="breadcrumb">
            <li>
               <a href="index-2.html"><i class="fa fa-home"></i>Home</a>
            </li>
            <li>
               <a href="ui-calendar.html">Pedidos</a>
            </li>
            <li class="active">
               <strong>Pedido Detalhes</strong>
            </li>
         </ol>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<div class="col-lg-12">
   <section class="box ">
      <div class="content-body">
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <!-- start -->
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <h3 class="pedido_status">{{ pedido.pedidoStatus.nome}}</h3>
                     <div class="invoice-head">
                        <div class="col-md-2 col-sm-12 col-xs-12 invoice-title">
                           <h2 class="text-center bg-primary "># {{pedido.id}}</h2>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12 invoice-head-info">
                           <strong>Endereço de entrega</strong><br/>
                           <span class='text-muted'>
                           {{endereco.logradouro}}, nº {{endereco.numero}} - {{endereco.bairro}}<br>
                           {{endereco.cidade.nome}}, {{endereco.estado.sigla}}<br>
                           {{endereco.complemento}}
                           </span>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12 invoice-head-info"><span class='text-muted'>Data: {{ Utilitarios.dateFormat(pedido.data)}}</span></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <br>
                  <div class="col-xs-6 invoice-infoblock pull-left">
                     <h4>Usuário:</h4>
                     <address>
                        <h4>{{ cliente.usuario.nome}}</h4>
                        <span class='text-muted'>
                           {{ cliente.usuario.email}}<br>
                           Telefone: {{cliente.telefone}} <br>
                           Celular: {{cliente.celular}}<br>
                       </span>
                     </address>
                  </div>
                  <div class="col-xs-6 invoice-infoblock text-right">
                     <h4>Forma de Pagamento:</h4>
                     <address>
                        <h3>{{pedido.Widgets.nome}}</h3>
                     </address>
                     <div class="invoice-due">
                        <h3 class="text-muted">Total</h3>
                        &nbsp; 
                        <h2 class="text-primary">R$ {{ Utilitarios.toMoney(pedido.total)}}</h2>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <br>
               </div>
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <h3>Itens do pedido</h3>
                     <br>
                     <div class="table-responsive">
                        <table class="table table-hover invoice-table">
                           <thead>
                              <tr>
                                 <td>
                                    <h4>Item</h4>
                                 </td>
                                 <td class="text-center">
                                    <h4>Preço</h4>
                                 </td>
                                 <td class="text-center">
                                    <h4>Quantidade</h4>
                                 </td>
                                 <td class="text-right">
                                    <h4>Total</h4>
                                 </td>
                              </tr>
                           </thead>
                           <tbody>
                              <!-- foreach ($order->lineItems as $line) or some such thing here -->
                              {% for item in pedido.itens%}
                                 {% set produto = Utilitarios.getProduto(item.produto_id) %}
                                 <tr>
                                    <td>
                                       <strong>{{produto.nome}}</strong> <br/>
                                       {% for detalhe in produto.detalhes if detalhe['detalhe_id'] == item.detalhe_id %}
                                         {{ Utilitarios.getProdutoDetalhes(detalhe)}}
                                       {% endfor %}
                                    </td>
                                    <td class="text-center">
                                       R$ {{ Utilitarios.toMoney(item.valor)}}
                                    </td>
                                    <td class="text-center">
                                       {{ item.quantidade}}
                                    </td>
                                    <td class="text-right">
                                       R$ {{ Utilitarios.toMoney(item.valor*item.quantidade)}}
                                    </td>
                                 </tr>
                              {% endfor %}
                              <tr>
                                 <td class="thick-line"></td>
                                 <td class="thick-line"></td>
                                 <td class="thick-line text-center">
                                    <h4>Subtotal</h4>
                                 </td>
                                 <td class="thick-line text-right">
                                    <h4>R$ {{ Utilitarios.toMoney(pedido.valor)}}</h4>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="no-line"></td>
                                 <td class="no-line"></td>
                                 <td class="no-line text-center">
                                    <h4>Frete</h4>
                                 </td>
                                 <td class="no-line text-right">
                                    <h4>R$ {{ Utilitarios.toMoney(pedido.frete)}}</h4>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="no-line"></td>
                                 <td class="no-line"></td>
                                 <td class="no-line text-center">
                                    <h4>Total</h4>
                                 </td>
                                 <td class="no-line text-right">
                                    <h3 style='margin:0px;' class="text-primary">  R$ {{ Utilitarios.toMoney(pedido.total)}}</h3>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <br>
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                     <a href="#" target="_blank" class="btn btn-purple btn-lg"><i class="fa fa-print"></i> &nbsp; Imprimir </a>        
                     <a href="javascript:;" target="_blank" class="btn btn-orange btn-lg setStausTrigger"><i class="fa fa-pencil"></i> &nbsp; Mudar status 
                        <select data-pedido="{{pedido.id}}" class="form-control setStaus" style="display:none" >
                           <option value="0">Selecione ...</option>
                           {% for status in pedido_status %}
                              <option value="{{ status.id}}" {{ pedido.status_id == status.id ? 'selected' :''}}>{{ status.nome}}</option>
                           {% endfor %}
                        </select>
                     </a>

                  </div>
               </div>
               <!-- end -->
            </div>
         </div>
      </div>
   </section>
</div>
