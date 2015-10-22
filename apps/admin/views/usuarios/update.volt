<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">Editar Usuario</h1>
      </div>
      <div class="pull-right hidden-xs">
         <ol class="breadcrumb">
            <li>
               {{ link_to('admin/usuarios/2','<i class="fa fa-home"></i>Home</a>')}}
            </li>
            <li class='active'>
               <a href="tables-basic.html">Editar Usuario</a>
            </li>
         </ol>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<div class="col-lg-12">
   <section class="box ">
         <div class="content-body">
            {{ form('admin/usuario/update/'~dados.id,'enctype': 'multipart/form-data') }}

               {{ partial('usuarios/_form')}}

               {{ submit_button("Editar", "class": "btn btn-primary") }}

            {{endForm()}}
         </div>
   </section>
</div>