<div class="page-sidebar ">
   <!-- MAIN MENU - START -->
   <div class="page-sidebar-wrapper" id="main-menu-wrapper">
      <ul class='wraplist'>
         <li class="open"> 
            {{ link_to('/admin/dashboard',
               '<i class="fa fa-dashboard"></i>
               <span class="title">Painel</span>'
               )
            }}
         </li>

         <li>
            {{ link_to('/admin/pedidos',
               '<i class="fa fa-shopping-cart"></i>
               <span class="title">Pedidos</span>'
               )
            }}
         </li>

         <li> 
            {{ link_to('/admin/categorias',
               '<i class="fa fa-th"></i>
               <span class="title">Categorias</span>'
               )
            }}
         </li>
        <li> 
            {{ link_to('/admin/produtos',
               '<i class="fa fa-cube"></i>
               <span class="title">Produtos</span>'
               )
            }}
         </li>

         <li>
            <a href="#">
               <i class="fa fa-bullhorn"></i>
               <span class="title">Marketing</span>
            </a>
            <ul class="sub-menu" >
               <li>
                  {{ link_to('/admin/cupons','Cupons de desconto')}}
               </li>
               <li>
                  {{ link_to('/admin/newsletter','Newsletter')}}
               </li>
               <li>
                  {{ link_to('/admin/fretes','Frete grátis')}}
               </li>
            </ul>
         </li>

         <li>
            <a href="javascript:;">
               <i class="fa fa-columns"></i>
               <span class="title">Layout</span>
            </a>
            <ul class="sub-menu" >
               <li>
                  {{ link_to('/admin/banners','Banners')}}
               </li>
            </ul>
         </li>

         <li>
            <a href="#">
               <i class="fa fa-sliders"></i>
               <span class="title">Atributos</span>
            </a>
            <ul class="sub-menu" >
               {% for attr in atributos %}
                  <li>
                     {{ link_to('/admin/atributos/'~attr['label'],base_helper.pluralize(attr['label'])|capitalize)}}
                  </li>
               {% endfor %}
            </ul>
         </li>

         <li>
             {{ link_to('/admin/relatorios',
                '<i class="fa fa-line-chart"></i>
                <span class="title">Relatórios</span>'
             )}}
         </li>

         <li>
            <a href="#">
               <i class="fa fa-sitemap"></i>
               <span class="title">Integrações</span>
            </a>
            <ul class="sub-menu" >
               <li><a href="#">Buscapé</a></li>
               <li><a href="#">Mercado livre</a></li>
            </ul>
         </li>


         <li>
            <a href="#target-upload"  data-url="{{url.getBaseUri()}}admin/upload" data-toggle="modal" class="call-upload">
               <i class="fa fa-picture-o"></i>
               <span class="title">Central de Mídia</span>
            </a>
         </li>

         <li>
            <a href="#">
               <i class="fa fa-gear"></i>
               <span class="title">Minha Loja</span>
            </a>
            <ul class="sub-menu" >
                <li>
                  {{ link_to('/admin/avaliacoes','Avaliações')}}
               </li>
               <li>
                  {{ link_to('/admin/usuarios/3','Clientes')}}
               </li>
               <li>
                  {{ link_to('/admin/usuarios/2','Administradores')}}
               </li>
               <li>
                  {{ link_to('/admin/pagamentos','Formas de pagamento')}}
               </li>
            </ul>
         </li>

         <li>
            <a href="#">
               <i class="fa fa-gears"></i>
               <span class="title">Configurações</span>
            </a>
            <ul class="sub-menu" >
               <li>
                  {{ link_to('/admin/loja/geral','Geral')}}
               </li>
               <li>
                  {{ link_to('/admin/loja/produtos','Produtos')}}
               </li>
            </ul>
         </li>
      </ul>
   </div>
</div>