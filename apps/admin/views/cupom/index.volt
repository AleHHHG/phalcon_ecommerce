<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">Cupons</h1>
      </div>
      <div class="pull-right hidden-xs">
         <ol class="breadcrumb">
             <li>
               {{ link_to('admin','<i class="fa fa-home"></i>Home</a>')}}
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
         {{ link_to('admin/cupom/create','Novo Cupom','class':'btn btn-primary btn-lg pull-right')}}
         <br clear="all"/>
      </header>
      <div class="content-body">
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th>Nome</th>
                        <th>Codigo</th>
                        <th>Cupons restantes</th>
                        <th>Ativo</th>
                        <th>Opçoes</th>
                     </tr>
                  </thead>
                  <tbody>
                  {% for dado in dados %}
                     <tr>
                        <td>
                           {{dado.nome}}
                        </td>
                        <td>
                           {{dado.codigo}}
                        </td>
                        <td>
                           {{dado.quantidade}}
                        </td>
                        <td>
                           {{dado.ativo ? 'SIM' : 'NÃO' }}
                        </td>
                        <td class='text-center'>
                           {{ link_to("admin/cupom/update/"~dado.id ,'<i class="fa fa-pencil icon-square icon-default "></i>'
                           )}}
                        </td>
                     </tr>
                  {% endfor %}
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </section>
</div>