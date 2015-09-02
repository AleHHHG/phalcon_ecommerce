<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">Pedidos</h1>
      </div>
      <div class="pull-right hidden-xs">
         <ol class="breadcrumb">
            <li>
               <a href="index-2.html"><i class="fa fa-home"></i>Home</a>
            </li>
            <li class='active'>
               <a href="tables-basic.html">Pedidos</a>
            </li>
         </ol>
      </div>
   </div>
   <?php $this->flashSession->output() ?>
</div>
<div class="clearfix"></div>
<div class="col-lg-12">
<section class="box ">
<div class="content-body">
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Data Pedido</th>
                  <th>Status</th>
                  <th>Forma de Pagamento</th>
                  <th>Valor</th>
                  <th>Frete</th>
                  <th>Metódo de Entrega</th>
                  <th>Opções</th>
               </tr>
            </thead>
            <tbody>
            {% for pedido in pedidos %}
               <tr>
                  <td>
                    {{pedido.id}}
                  </td>
                  <td>
                    {{Utilitarios.dateFormat(pedido.data)}}
                  </td>
                 <td>
                     {{pedido.PedidoStatus.nome}}
                  </td>
                  <td>
                     {{pedido.Widgets.nome}}
                  </td>
                  <td>
                     R$ {{Utilitarios.toMoney(pedido.valor)}}
                  </td>
                  <td>
                     R$ {{Utilitarios.toMoney(pedido.frete)}}
                  </td>
                   <td>
                     {{pedido.FreteTipos.nome}}
                  </td>
                  <td class='text-center'>
                     {{ link_to("admin/pedido/detalhes/"~pedido.id ,'<i class="fa fa-file-text-o icon-square icon-orange ">&nbsp</i> ','title':'Detalhes')}}
                  </td>
               </tr>
            {% endfor %}
            </tbody>
         </table>
      </div>
   </div>
</div>