<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
   <div class="page-title">
      <div class="pull-left">
         <h1 class="title"><img src="{{ pagamento.logo}}"></h1>
      </div>
      <div class="pull-right hidden-xs">
         <ol class="breadcrumb">
            <li>
               <a href="index-2.html"><i class="fa fa-home"></i>Home</a>
            </li>
            <li class='active'>
               {{ link_to('admin/pagamentos','Pagamentos')}}
            </li>
         </ol>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<div class="col-lg-12">
   <section class="box ">
         <div class="content-body">
            {{ form("admin/pagamento/update/"~pagamento.id,'mehtod':'post') }}

               {{ partial('pagamentos/_form')}}

               {{ submit_button("Editar", "class": "btn btn-primary") }}

            {{endForm()}}
         </div>
   </section>
</div>