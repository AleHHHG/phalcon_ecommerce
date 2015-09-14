<div class='page-topbar '>
   <div class='logo-area'></div>
   <div class='quick-area'>
      <div class='pull-left'>
         <ul class="info-menu left-links list-inline list-unstyled">
            <li class="notify-toggle-wrapper">
               <a href="#" data-toggle="dropdown" class="toggle">
               <i class="fa fa-bell"></i>
               <span class="badge badge-orange">3</span>
               </a>
               <ul class="dropdown-menu notifications animated fadeIn">
                  <li class="total">
                     <span class="small">
                     You have <strong>3</strong> new notifications.
                  </li>
                  <li class="list">
                     <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                        <li class=" busy">
                           <!-- available: success, warning, info, error -->
                           <a href="javascript:;">
                              <div class="notice-icon">
                                 <i class="fa fa-times"></i>
                              </div>
                              <div>
                                 <span class="name">
                                 <strong>Team Meeting at 6PM</strong>
                                 <span class="time small">16th Mar</span>
                                 </span>
                              </div>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="external">
                     <a href="javascript:;">
                     <span>Read All Notifications</span>
                     </a>
                  </li>
               </ul>
            </li>
         </ul>
      </div>
      <div class='pull-right'>
         <ul class="info-menu right-links list-inline list-unstyled">
            <li class="profile">
               <a href="#" data-toggle="dropdown" class="toggle">
                  <span>Jason Bourne <i class="fa fa-angle-down"></i></span>
               </a>
               <ul class="dropdown-menu profile animated fadeIn">
                  <li>
                     <a href="#settings">
                     <i class="fa fa-wrench"></i>
                     Configurações
                     </a>
                  </li>
                  <li class="last">
                     {{ link_to('admin/logout','<i class="fa fa-lock"></i>
                     Sair')}}
                  </li>
               </ul>
            </li>
         </ul>
      </div>
   </div>
</div>