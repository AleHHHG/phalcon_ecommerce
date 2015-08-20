<!DOCTYPE html>
<html>
    <?php echo $this->partial('layouts/_head'); ?>
    <body>
      <?php echo $this->partial('template/header'); ?>
      <?php echo $this->getContent(); ?>
      <?php echo $this->partial('template/footer'); ?>
    </body>
    <?php echo $this->partial('layouts/_scripts'); ?>
</html>
