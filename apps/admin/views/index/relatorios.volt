<div class="col-md-12">
   <div class="page-title">
         <h1 class="title">
          {% if this.request.isPost() %}
            Relatório {{Utilitarios.dateFormat(this.request.getPost('inicial'),'d/m/y')}} à {{Utilitarios.dateFormat(this.request.getPost('final'),'d/m/y')}}
          {% else %}
            Relatório
          {% endif %}
            <a href="#" data-toggle="modal" data-target="#filtro-relatorio" class="btn btn-orange pull-right"><i class="fa fa-filter"></i> Filtro</a>
         </h1>
   </div>
   <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <section class="box ">
            <header class="panel_header custom-header">
               <h2 class="title pull-left">Vendas</h2>
            </header>
            <div class="content-body">
               <div id="chart1" style="width:100%;height:100%"></div>
            </div>
         </section>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <section class="box ">
            <header class="panel_header custom-header">
               <h2 class="title pull-left">Produtos mais vendidos</h2>
            </header>
            <div class="content-body">
               <div id="chart2" style="width:100%;height:100%"></div>  
            </div>
         </section>
      </div>
   </div>
   <div class="row">
   <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
         <section class="box ">
            <header class="panel_header custom-header">
               <h2 class="title pull-left">Pedidos Realizados/ Pedidos Concluidos</h2>
            </header>
            <div class="content-body"> 
               <div id="chart4" style="width:100%;height:100%"></div> 
            </div>
         </section>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
         <section class="box ">
            <header class="panel_header custom-header">
               <h2 class="title pull-left">Vendas por estado</h2>
            </header>
            <div class="content-body">
               <div id="chart5" style="width:100%;height:100%"></div>
            </div>
         </section>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
         <section class="box ">
            <header class="panel_header custom-header">
               <h2 class="title pull-left">Formas de pagamento</h2>
            </header>
            <div class="content-body">
               <div id="chart6" style="width:100%;height:100%"></div>
            </div>
         </section>
      </div>
   </div>
</div>

<div class="modal fade" id="filtro-relatorio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Filtro</h4>
      </div>
      {{ form('admin/relatorios', 'method': 'post') }}
        <div class="modal-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label>Data inicial</label>
                {{ date_field('inicial','class':'form-control')}}
              </div>
              <div class="form-group col-md-6">
                <label>Data final</label>
                {{ date_field('final','class':'form-control')}}
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          {{ submit_button('Filtrar','class':'btn btn-primary')}}
        </div>
      {{ end_form()}}
    </div>
  </div>
</div>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<!-- Grafico de Aréa -->
<script type="text/javascript">
   google.load("visualization", "1", {packages:["corechart"]});
   google.setOnLoadCallback(drawChart);
  var vendas = [['Dia', 'Vendas']]
  {% for vendidos in vendas %}
    vendas.push(['{{ vendidos.data}}',{{vendidos.total}}])
  {% endfor %}
   function drawChart() {
     var data = google.visualization.arrayToDataTable(vendas);

     var options = {
       vAxis: {minValue: 0},
       chartArea: {width: '90%',height:'80%'},
       pointSize:8,
       legend:'none',
     };

     var chart = new google.visualization.AreaChart(document.getElementById('chart1'));
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
        textStyle:{color:'white',auraColor:'none',fontSize:14}
      },
      bar: { groupWidth: "90%" }
    };
    var chart = new google.visualization.BarChart(document.getElementById('chart2'));
    chart.draw(data, options);
  }
</script>

<!-- Grafico Realizado / Concludidos -->
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
       chartArea: {width: '95%',height:'90%'},
     };

     var chart = new google.visualization.PieChart(document. getElementById('chart4'));
     chart.draw(data, options);
   }
</script>

<!-- Grafico vendas por estado -->
<script type="text/javascript">
   google.load("visualization", "1", {packages:["corechart"]});
   google.setOnLoadCallback(drawChart);
   var estados = [['Estado', 'Vendas']]
   {% for index,estado in estados %}
    estados.push(['{{ index}}',{{estado}}])
   {% endfor %}
   function drawChart() {
     var data = google.visualization.arrayToDataTable(estados);
     var options = {
       pieHole: 0.4,
       chartArea: {width: '95%',height:'90%'},
     };

     var chart = new google.visualization.PieChart(document. getElementById('chart5'));
     chart.draw(data, options);
   }
</script>

<script type="text/javascript">
   google.load("visualization", "1", {packages:["corechart"]});
   google.setOnLoadCallback(drawChart);
  var estatistica = [['Forma de Pagamento', 'Vendas']]
   {% for dados in pagamento %}
    estatistica.push(['{{ dados['forma_pagamento']}}',{{dados['quantidade']}}])
   {% endfor %}
   function drawChart() {
     var data = google.visualization.arrayToDataTable(estatistica);

     var options = {
       pieHole: 0.4,
       chartArea: {width: '95%',height:'90%'},
     };

     var chart = new google.visualization.PieChart(document. getElementById('chart6'));
     chart.draw(data, options);
   }
</script>
