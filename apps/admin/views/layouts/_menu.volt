<div class="page-sidebar ">
   <!-- MAIN MENU - START -->
   <div class="page-sidebar-wrapper" id="main-menu-wrapper">
      <!-- USER INFO - START -->
      <div class="profile-info row">
         <div class="profile-image col-md-4 col-sm-4 col-xs-4">
            <a href="ui-profile.html">
            <img src="http://cptstatic.s3.amazonaws.com/imagens/enviadas/materias/materia10372/3criacao-de-capivaras-curso-cpt.jpg" class="img-responsive img-circle">
            </a>
         </div>
         <div class="profile-details col-md-8 col-sm-8 col-xs-8">
            <h3>
               <a href="ui-profile.html">Jason Bourne</a>
               <span class="profile-status online"></span>
            </h3>
            <p class="profile-title">Web Developer</p>
         </div>
      </div>
      <!-- USER INFO - END -->
      <ul class='wraplist'>
         <li class="open"> 
            <a href="javascript:;">
               <i class="fa fa-dashboard"></i>
               <span class="title">Painel</span>
            </a>
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
               <i class="fa fa-sliders"></i>
               <span class="title">Loja</span>
            </a>
            <ul class="sub-menu" >
               <li>
                  {{ link_to('/admin/loja/geral','Geral')}}
               </li>
               <li>
                  {{ link_to('/admin/loja/produtos','Produtos')}}
               </li>
               <li>
                  <a href="javascript:;">Design</a>
                  <ul class="sub-menu" >
                     <li>{{ link_to('/admin/banners','Banners')}}</li>
                     <li><a href='#'><span>Layouts</span></a></li>
                  </li>
               </li>
            </ul>
         </li>
      </ul>
   </div>
   <!-- MAIN MENU - END -->
   <div class="project-info">
      <div class="block1">
         <div class="data">
            <span class='title'>New&nbsp;Orders</span>
            <span class='total'>2,345</span>
         </div>
         <div class="graph">
            <span class="sidebar_orders">...</span>
         </div>
      </div>
      <div class="block2">
         <div class="data">
            <span class='title'>Visitors</span>
            <span class='total'>345</span>
         </div>
         <div class="graph">
            <span class="sidebar_visitors">...</span>
         </div>
      </div>
   </div>
</div>