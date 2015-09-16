<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">{{ nivel == 2 ? 'Usuários' : 'Clientes' }}</h1>
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
      <div class="content-body">
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
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
                           {{dado.email}}
                        </td>
                        <td class='text-center'>
                           {% if dado.nivel_id == 3 %}
                              {{ link_to("admin/usuario/detalhe/"~dado.id ,'<i class="fa fa-file-text-o icon-square icon-default "></i>'
                              )}}
                           {% else %}
                              {% if session.get('admin_nivel') == 1 %}
                                 {{ link_to("admin/usuario/uodate/"~dado.id ,'<i class="fa fa-times icon-square icon-danger "></i>'
                                 )}}
                              {% endif %}
                           {% endif %}
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