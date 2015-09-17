<div class="col-md-12">
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">Painel</h1>
      </div>
   </div>
   <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="r4_counter db_box">
            <i class="pull-left fa fa-cubes icon-md icon-rounded icon-primary"></i>
            <div class="stats">
               <h4><strong>{{ numeros['produtos']}}</strong></h4>
               <span>Produtos</span>
            </div>
         </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="r4_counter db_box">
            <i class="pull-left fa fa-shopping-cart icon-md icon-rounded icon-orange"></i>
            <div class="stats">
               <h4><strong>{{ numeros['pedidos']}}</strong></h4>
               <span>Pedidos</span>
            </div>
         </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="r4_counter db_box">
            <i class="pull-left fa fa-dollar icon-md icon-rounded icon-purple"></i>
            <div class="stats">
               <h4><strong>R$ {{ Utilitarios.toMoney(numeros['total_vendas'])}}</strong></h4>
               <span>Vendas Concluidas</span>
            </div>
         </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="r4_counter db_box">
            <i class="pull-left fa fa-users icon-md icon-rounded icon-warning"></i>
            <div class="stats">
               <h4><strong>{{ numeros['usuarios']}}</strong></h4>
               <span>Usuários</span>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
         <section class="box ">
            <header class="panel_header custom-header">
               <h2 class="title pull-left">Produtos mais vendidos</h2>
            </header>
            <div class="content-body">
               <div id="chart1" style="width:100%;height:100%"></div>
            </div>
         </section>
      </div>
       <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
         <section class="box ">
            <header class="panel_header custom-header">
               <h2 class="title pull-left">Ultimos pedidos</h2>
            </header>
            <div class="content-body">
                  <table class="table table-striped dt-responsive display">
                     <thead>
                        <tr>
                           <th>Data Pedido</th>
                           <th>Status</th>
                           <th>Total</th>
                           <th>Opções</th>
                        </tr>
                     </thead>
                     <tbody>
                     {% for pedido in ultimos_pedidos %}
                        <tr>
                           <td>
                             {{Utilitarios.dateFormat(pedido.data)}}
                           </td>
                         
                           <td>
                              {{pedido.PedidoStatus.nome}}
                           </td>
                           <td>
                              R$ {{Utilitarios.toMoney(pedido.total)}}
                           </td>
                           <td class='text-center'>
                              {{ link_to("admin/pedido/detalhes/"~pedido.id ,'<i class="fa fa-file-text-o icon-square icon-orange ">&nbsp</i> ','title':'Detalhes')}}
                           </td>
                        </tr>
                     {% endfor %}
                     </tbody>
                  </table>
            </div>
         </section>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
         <section class="box ">
            <header class="panel_header custom-header">
               <h2 class="title pull-left">Pedidos realizados / Pedidos concluidos</h2>
            </header>
            <div class="content-body">
               <div id="chart2" style="width:100%;height:100%"></div>
            </div>
         </section>
      </div>
   </div>
</div>

 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Status', 'Total'],
    ['Concluidos', {{pedidos['concluidos']}}],
    ['Realizados', {{pedidos['realizados']}}],
  ]);

  var options = {
    pieHole: 0.4,
    chartArea: {width: '100%',height:'90%'},
  };

  var chart = new google.visualization.PieChart(document. getElementById('chart2'));
  chart.draw(data, options);
}
</script>


<!-- Grafico de barras -->
<script type="text/javascript">
  google.load('visualization', '1', {packages: ['corechart', 'bar']});
  google.setOnLoadCallback(drawBasic);
  var produtos = [['Produtos', 'Vendas']]
  {% for vendidos in mais_vendidos %}
    produtos.push(['{{ vendidos['produto']}}',{{vendidos['quantidade']}}])
  {% endfor %}
  function drawBasic() {
    var data = google.visualization.arrayToDataTable(produtos);
    var options = {
      legend: { position: 'none' },
      chartArea: {width: '95%',height:'80%'},
      hAxis: {
        minValue: 0,
      },
      vAxis: {
        textPosition: 'in',
        textStyle:{color:'white',auraColor:'none',fontSize:12}
      },
      bars: 'horizontal',
      bar: { groupWidth: "70%" }
    };
    var chart = new google.visualization.BarChart(document.getElementById('chart1'));
    chart.draw(data, options);
  }
</script>