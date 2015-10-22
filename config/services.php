<?php
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as FlashDirect;
use Moltin\Cart\Cart;
use Moltin\Cart\Storage\Session;
use Moltin\Cart\Identifier\Cookie;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

$di->set('ecommerce_options',function(){
    return new Ecommerce\Admin\Models\Options;
});


$di->set('url', function () use ($di) {
    $eo = $di->getShared('ecommerce_options');
    $url = new UrlResolver();
    $url->setBaseUri($eo->url_base);
    return $url;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
    return new DbAdapter($config->database->toArray());
});

 
$di->set('flash', function(){
    $flash = new FlashDirect(array(
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ));
    return $flash;
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();
    return $session;
});

$di->setShared('cart', function () {
    return new Cart(new Session, new Cookie);
});

$di->set('router', function () {
    $router = new Router();
    $config = include __DIR__ . "/routes.php";
    return $router;
});


$di->set('mongo', function() {
    $mongo = new MongoClient();
    return $mongo->selectDB("plataforma");
}, true);


$di->set('collectionManager', function(){
    return new Phalcon\Mvc\Collection\Manager();
}, true);

$di->set('helper',function(){
    $helper = new stdClass;
    $helper->banner =  new Ecommerce\Loja\Helpers\BannerHelper;
    $helper->menu =  new Ecommerce\Loja\Helpers\MenuHelper;
    $helper->produto = new Ecommerce\Loja\Helpers\ProdutoHelper;
    $helper->sidebar = new Ecommerce\Loja\Helpers\SideBarHelper;
    $helper->single = new Ecommerce\Loja\Helpers\SingleHelper;
    $helper->cart = new Ecommerce\Loja\Helpers\CartHelper;
    $helper->topBar = new Ecommerce\Loja\Helpers\TopBarHelper;
    $helper->comparacao = new Ecommerce\Loja\Helpers\ComparacaoHelper;
    $helper->footer = new Ecommerce\Loja\Helpers\FooterHelper;
    $helper->search = new Ecommerce\Loja\Helpers\SearchHelper;
    $helper->mailer = new Ecommerce\Loja\Helpers\MailerHelper;
    return $helper;
});



