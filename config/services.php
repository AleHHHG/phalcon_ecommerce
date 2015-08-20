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

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri('http://localhost/mare_mansa/');
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
    if(!isset($_SESSION)){
        $session->start();
    }
    return $session;
});

$di->set('router', function () {
    $router = new Router();
    $config = include __DIR__ . "/routes.php";
    return $router;
});


$di->set('mongo', function() {
    $mongo = new MongoClient();
    return $mongo->selectDB("ecommerce");
}, true);


$di->set('collectionManager', function(){
    return new Phalcon\Mvc\Collection\Manager();
}, true);


$di->set('ecommerce_options',function(){
    return new Ecommerce\Admin\Models\Options;
});

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
    return $helper;
});



