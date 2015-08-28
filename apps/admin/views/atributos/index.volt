<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">{{titulo}}</h1>
      </div>
      <div class="pull-right hidden-xs">
         <ol class="breadcrumb">
            <li>
               <a href="javascript:;"><i class="fa fa-home"></i>Home</a>
            </li>
             <li>
               <a href="javascript:;">Atributos</a>
            </li>
            <li class='active'>
               <a href="tables-basic.html">{{titulo|capitalize}}</a>
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
   {{ link_to('admin/atributos/'~param~'/create','<i class="fa fa-plus"></i> '~titulo|capitalize,'class':'btn btn-primary btn-lg pull-right')}}
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
            {% for item in dados %}
               <tr>
                  <td>
                     <strong>{{item['nome']}}</strong>
                  </td>
                  <td class='text-center'>
                     {{ link_to("admin/atributos/"~param~"/update/"~item['id'] ,'<i class="fa fa-pencil icon-square icon-default "></i>'
                     )}}

                     {{ link_to("admin/atributos/"~param~"/delete/"~item['id'] ,'<i class="fa fa-times icon-square icon-danger "></i>'
                     )}}
                  </td>
               </tr>
            {% endfor %}
            </tbody>
         </table>
      </div>
   </div>
</div>