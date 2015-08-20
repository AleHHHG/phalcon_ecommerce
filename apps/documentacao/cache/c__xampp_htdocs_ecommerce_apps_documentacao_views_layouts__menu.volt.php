<div class="page-sidebar">
   <!-- MAIN MENU - START -->
   <div class="page-sidebar-wrapper" id="main-menu-wrapper">
      <ul class='wraplist'>
         <?php foreach ($menu as $item) { ?>
         <li class="">
            <?php echo $this->tag->linkTo(array('/documentacao/show/' . $item->id, $item->nome)); ?>
            <ul class="sub-menu" ></ul>
         </li>
         <?php } ?>
      </ul>
   </div>
</div>