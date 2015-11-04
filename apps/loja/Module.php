<?php

namespace Ecommerce\Loja;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;


class Module implements ModuleDefinitionInterface{

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders(DiInterface $di = null)
    {

        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'Ecommerce\Loja\Controllers' => '../apps/loja/controllers/',
                'Ecommerce\Loja\Models'      => '../apps/loja/models/',
                'Ecommerce\Loja\Helpers'      => '../apps/loja/helpers/',
                'Ecommerce\Loja\Customs'      => '../apps/loja/customs/',
                'Ecommerce\Loja\Forms'      => '../apps/loja/forms/',
                'Ecommerce\Admin\Models'      => '../apps/admin/models/',
                'Ecommerce\Admin\Helpers'      => '../apps/admin/helpers/',
            )
        );
        require('vendor/autoload.php');
        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices(DiInterface $di)
    {

        $di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Ecommerce\Loja\Controllers');
            return $dispatcher;
        });

        // Registering the view component
        $di->set('view', function() {
            $config = include __DIR__ . "/config/config.php";
            $view = new View();
            $view->registerEngines(array(
                '.volt' => function ($view, $di) use ($config) {

                    $volt = new VoltEngine($view, $di);

                    $volt->setOptions(array(
                        'compiledPath' => $config->application->cacheDir,
                        'compiledSeparator' => '_'
                    ));

                    return $volt;
                },
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
            ));
            $view->setViewsDir('../apps/loja/views/');
            return $view;
        });
    }
}