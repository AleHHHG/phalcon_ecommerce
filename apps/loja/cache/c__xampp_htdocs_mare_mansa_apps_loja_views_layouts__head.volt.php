<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $this->ecommerce_options->titulo; ?></title>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,200,100,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:400,100,300,300italic,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <?php echo $this->tag->stylesheetLink('css/bootstrap.css'); ?>
    <?php foreach ($css as $arquivo) { ?>
        <?php echo $this->tag->stylesheetLink($arquivo); ?>
    <?php } ?>
    <?php echo $this->tag->stylesheetLink('css/loja/toastr.css'); ?>
    <?php echo $this->tag->stylesheetLink('css/loja/base.css'); ?>
</head>