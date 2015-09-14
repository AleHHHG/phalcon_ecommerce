 <?php 
$router->add("/", array(
    'module'     => 'loja',
    'controller' => 'index',
));

$router->add("/categoria/{categoria:[a-zA-Z0-9_-]+}/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'loja',
    'controller' => 'categoria',
));

$router->add("/categoria/filtro/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'loja',
    'controller' => 'categoria',
    'action' => 'filtro',
));

$router->add("/categoria/paginacao/{id:[a-zA-Z0-9]+}/{pagina:[0-9]+}", array(
    'module'     => 'loja',
    'controller' => 'categoria',
    'action' => 'paginacao',
));


$router->add("/produto/{produto:[a-zA-Z0-9_-]+}/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'loja',
    'controller' => 'produto',
));

$router->add("/produto_variacao/{produto:[a-zA-Z0-9_-]+}/{id:[a-zA-Z0-9]+}/{detalhe:[\sa-zA-Z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ_-]+}/{posicao:[0-9]+}", array(
    'module'     => 'loja',
    'controller' => 'produto',
    'action' => 'variacao',
));

$router->add("/produto/avaliacao", array(
    'module'     => 'loja',
    'controller' => 'produto',
    'action' => 'avaliacao',
));

$router->add("/comparacao", array(
    'module'     => 'loja',
    'controller' => 'comparacao',
));

$router->add("/comparacao/create", array(
    'module'     => 'loja',
    'controller' => 'comparacao',
    'action' => 'create',
));

$router->add("/comparacao/delete/{id:[a-zA-Z0-9_-]+}", array(
    'module'     => 'loja',
    'controller' => 'comparacao',
    'action' => 'delete',
));

#Carrinho

$router->add("/cart", array(
    'module'     => 'loja',
    'controller' => 'cart',
));

$router->add("/cart/fragment", array(
    'module'     => 'loja',
    'controller' => 'cart',
    'action' => 'fragment'
));

$router->add("/cart/calculo", array(
    'module'     => 'loja',
    'controller' => 'cart',
    'action' => 'calculo'
));

$router->add("/cart/insert", array(
    'module'     => 'loja',
    'controller' => 'cart',
    'action' => 'insert'
));

$router->add("/cart/update/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'loja',
    'controller' => 'cart',
    'action' => 'update'
));

$router->add("/cart/remove/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'loja',
    'controller' => 'cart',
    'action' => 'remove'
));


$router->add("/cart/destroy", array(
    'module'     => 'loja',
    'controller' => 'cart',
    'action' => 'destroy'
));

$router->add("/checkout", array(
    'module'     => 'loja',
    'controller' => 'checkout',
));

$router->add("/checkout/confirmacao/{id:[0-9]+}", array(
    'module'     => 'loja',
    'controller' => 'checkout',
    'action' => 'confirmacao'
));

$router->add("/checkout/finalizar", array(
    'module'     => 'loja',
    'controller' => 'checkout',
    'action' => 'finalizar'
));

$router->add("/checkout/confirmacao", array(
    'module'     => 'loja',
    'controller' => 'checkout',
    'action' => 'confirmacao'
));

$router->add("/user", array(
    'module'     => 'loja',
    'controller' => 'user',
));

$router->add("/user/login", array(
    'module'     => 'loja',
    'controller' => 'user',
    'action' => 'login',
));

$router->add("/user/logout", array(
    'module'     => 'loja',
    'controller' => 'user',
    'action' => 'logout',
));

$router->add("/user/create", array(
    'module'     => 'loja',
    'controller' => 'user',
    'action' => 'create',
));

$router->add("/user/edit/{param:[a-zA-Z0-9]+}", array(
    'module'     => 'loja',
    'controller' => 'user',
    'action' => 'edit',
));

$router->add("/user/pedidos", array(
    'module'     => 'loja',
    'controller' => 'user',
    'action' => 'pedidos',
));

$router->add("/user/avaliacoes", array(
    'module'     => 'loja',
    'controller' => 'user',
    'action' => 'avaliacoes',
));


######################################################
######################################################
#               Rotas do administrador
######################################################
######################################################



$router->add("/admin", array(
    'module'     => 'admin',
    'controller' => 'login',
));

#LOGIN

$router->add("/admin/login", array(
    'module'     => 'admin',
    'controller' => 'login',
    'action' => 'create',
));

$router->add("/admin/logout", array(
    'module'     => 'admin',
    'controller' => 'login',
    'action' => 'logout',
));

# PAINEL

$router->add("/admin/dashboard", array(
    'module'     => 'admin',
    'controller' => 'index',
));

#Rota Categorias

$router->add("/admin/categorias", array(
    'module'     => 'admin',
    'controller' => 'categoria',
));

$router->add("/admin/categoria/create", array(
    'module'     => 'admin',
    'controller' => 'categoria',
    'action' => 'create'
));

$router->add("/admin/categoria/update/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'admin',
    'controller' => 'categoria',
    'action' => 'update'
));

$router->add("/admin/categoria/delete/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'admin',
    'controller' => 'categoria',
    'action' => 'delete'
));

#Rota Produtos

$router->add("/admin/produtos", array(
    'module'     => 'admin',
    'controller' => 'produto',
    'action' => 'index',
));

$router->add("/admin/produto/create", array(
    'module'     => 'admin',
    'controller' => 'produto',
    'action' => 'create',
));

$router->add("/admin/produto/integracao", array(
    'module'     => 'admin',
    'controller' => 'produto',
    'action' => 'integracao',
));

$router->add("/admin/produto/update/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'admin',
    'controller' => 'produto',
    'action' => 'update',
));

$router->add("/admin/produto/delete/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'admin',
    'controller' => 'produto',
    'action' => 'delete',
));

$router->add("/admin/produto/set-cor", array(
    'module'     => 'admin',
    'controller' => 'produto',
    'action' => 'setcor',
));

# Rota Loja

$router->add("/admin/loja/geral", array(
    'module'     => 'admin',
    'controller' => 'loja',
    'action' => 'geral',
));

$router->add("/admin/loja/produtos", array(
    'module'     => 'admin',
    'controller' => 'loja',
    'action' => 'produtos',
));

#Rota Banner

$router->add("/admin/banners", array(
    'module'     => 'admin',
    'controller' => 'banner',
    'action' => 'index',
));

$router->add("/admin/banner/create", array(
    'module'     => 'admin',
    'controller' => 'banner',
    'action' => 'create',
));

$router->add("/admin/banner/update/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'admin',
    'controller' => 'banner',
    'action' => 'update',
));

$router->add("/admin/banner/delete/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'admin',
    'controller' => 'banner',
    'action' => 'delete',
));

# Atributos

$router->add("/admin/atributos/{param:[a-zA-Z0-9]+}", array(
    'module'     => 'admin',
    'controller' => 'atributos',
    'action' => 'index',
));

$router->add("/admin/atributos/{param:[a-zA-Z0-9]+}/create", array(
    'module'     => 'admin',
    'controller' => 'atributos',
    'action' => 'create',
));

$router->add("/admin/atributos/{param:[a-zA-Z0-9]+}/update/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'admin',
    'controller' => 'atributos',
    'action' => 'update',
));

$router->add("/admin/atributos/{param:[a-zA-Z0-9]+}/delete/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'admin',
    'controller' => 'atributos',
    'action' => 'delete',
));


#ROTA PEDIDOS

$router->add("/admin/pedidos", array(
    'module'     => 'admin',
    'controller' => 'pedido'
));

$router->add("/admin/pedido/detalhes/{id:[a-zA-Z0-9]+}", array(
    'module'     => 'admin',
    'controller' => 'pedido',
    'action' => 'show'
));

$router->add("/admin/pedido/update", array(
    'module'     => 'admin',
    'controller' => 'pedido',
    'action' => 'update'
));

#UPLOAD ROTA

$router->add("/admin/upload/{tabela:[a-zA-Z0-9]+}/{coluna:[a-zA-Z0-9]+}", array(
    'module'     => 'admin',
    'controller' => 'upload',
));

$router->add("/admin/upload/create/{tabela:[a-zA-Z0-9]+}/{coluna:[a-zA-Z0-9]+}", array(
    'module'     => 'admin',
    'controller' => 'upload',
    'action' => 'create'
));

$router->add("/admin/upload/show/{tabela:[a-zA-Z0-9]+}/{coluna:[a-zA-Z0-9]+}", array(
    'module'     => 'admin',
    'controller' => 'upload',
    'action' => 'show'
));



######################################################
######################################################
#               Documentação
######################################################
######################################################

$router->add("/documentacao", array(
    'module'     => 'documentacao',
    'controller' => 'index',
));

$router->add("/documentacao/create", array(
    'module'     => 'documentacao',
    'controller' => 'index',
    'action' => 'create'
));

$router->add("/documentacao/update/{id:[0-9]+}", array(
    'module'     => 'documentacao',
    'controller' => 'index',
    'action' => 'update'
));

$router->add("/documentacao/delete/{id:[0-9]+}", array(
    'module'     => 'documentacao',
    'controller' => 'index',
    'action' => 'delete'
));

$router->add("/documentacao/show/{id:[0-9]+}", array(
    'module'     => 'documentacao',
    'controller' => 'index',
    'action' => 'show',
));