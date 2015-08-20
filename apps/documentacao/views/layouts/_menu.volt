<div class="page-sidebar">
   <!-- MAIN MENU - START -->
   <div class="page-sidebar-wrapper" id="main-menu-wrapper">
      <ul class='wraplist'>
         {% for item in menu %}
         <li class="">
            {{ link_to('/documentacao/show/'~item.id,item.nome)}}
            <ul class="sub-menu" ></ul>
         </li>
         {% endfor %}
      </ul>
   </div>
</div>