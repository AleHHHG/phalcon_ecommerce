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

         <li class="">
            {{ link_to('/admin/pedidos',
               '<i class="fa fa-shopping-cart"></i>
               <span class="title">Pedidos</span>'
               )
            }}
         </li>

         <li class=""> 
            {{ link_to('/admin/categorias',
               '<i class="fa fa-th"></i>
               <span class="title">Categorias</span>'
               )
            }}
         </li>
        <li class=""> 
            {{ link_to('/admin/produtos',
               '<i class="fa fa-cube"></i>
               <span class="title">Produtos</span>'
               )
            }}
         </li>

         <li class="">
            <a href="#">
               <i class="fa fa-bullhorn"></i>
               <span class="title">Marketing</span>
            </a>
            <ul class="sub-menu" >
               <li><a href="#">Cupons de desconto</a></li>
               <li>
                  {{ link_to('/admin/newsletter','Newsletter')}}
               </li>
               <li>
                  {{ link_to('/admin/fretes','Frete Grátis')}}
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

         <li class="">
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

         <li class="">
            <a href="#">
               <i class="fa fa-gears"></i>
               <span class="title">Loja</span>
            </a>
            <ul class="sub-menu" >
               <li>
                  {{ link_to('/admin/loja/geral','Geral')}}
               </li>
               <li>
                  {{ link_to('/admin/usuarios/2','Usuarios')}}
               </li>
               <li>
                  {{ link_to('/admin/avaliacoes','Avaliações')}}
               </li>
                <li>
                  {{ link_to('/admin/usuarios/3','Clientes')}}
               </li>
               <li>
                  {{ link_to('/admin/loja/produtos','Produtos')}}
               </li>
            </ul>
         </li>
      </ul>
   </div>
</div>