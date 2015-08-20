<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ ecommerce_options.titulo}}</title>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,200,100,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:400,100,300,300italic,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    {{ stylesheet_link('css/bootstrap.css') }}
    {% for arquivo in css%}
        {{ stylesheet_link(arquivo) }}
    {% endfor %}
    {{ stylesheet_link('css/loja/toastr.css') }}
    {{ stylesheet_link('css/loja/base.css') }}
</head>