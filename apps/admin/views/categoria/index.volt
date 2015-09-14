<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">Categorias</h1>
      </div>
      <div class="pull-right hidden-xs">
         <ol class="breadcrumb">
            <li>
               <a href="index-2.html"><i class="fa fa-home"></i>Home</a>
            </li>
            <li class='active'>
               <a href="tables-basic.html">Categorias</a>
            </li>
         </ol>
      </div>
   </div>
   <?php $this->flashSession->output() ?>
</div>
<div class="clearfix"></div>
<div class="col-lg-12">
<section class="box ">
<header class="panel_header">
   {{ link_to('admin/categoria/create','Nova Categoria','class':'btn btn-primary btn-lg pull-right')}}
   <br clear="all"/>
</header>
<div class="content-body">
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th>Nome</th>
                  <th>Opções</th>
               </tr>
            </thead>
            <tbody>
            {% for categoria in categorias %}
               <tr>
                  <td>
                     {% if categoria.pai is defined %}
                        {% for pai in categoria.pai%}
                           {{pai.nome}} / 
                        {% endfor %}
                     {%endif%}
                     <strong>{{categoria.nome}}</strong>
                  </td>
                  <td class='text-center'>

                     {{ link_to("admin/categoria/update/"~categoria._id ,'<i class="fa fa-pencil icon-square icon-default "></i>'
                     )}}

                     {{ link_to("admin/categoria/delete/"~categoria._id ,'<i class="fa fa-times icon-square icon-danger "></i>'
                     )}}
                    
                  </td>
               </tr>
            {% endfor %}
            </tbody>
         </table>
      </div>
   </div>
</div>