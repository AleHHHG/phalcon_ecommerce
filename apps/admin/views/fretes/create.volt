<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title">Novo Frete</h1>
      </div>
      <div class="pull-right hidden-xs">
         <ol class="breadcrumb">
            <li>
               {{ link_to('admin','<i class="fa fa-home"></i>Home</a>')}}
            </li>
            <li class='active'>
               {{ link_to('admin','Fretes')}}
            </li>
         </ol>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<div class="col-lg-12">
   <section class="box ">
         <div class="content-body">
            {{ form("admin/frete/create",'mehtod':'post') }}

               {{ partial('fretes/_form')}}

               {{ submit_button("Adicionar", "class": "btn btn-primary") }}

            {{endForm()}}
         </div>
   </section>
</div>