<?php

namespace Ecommerce\Admin;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface{

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector = NULL)
    {

        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'Ecommerce\Admin\Controllers' => '../apps/admin/controllers/',
                'Ecommerce\Admin\Models'      => '../apps/admin/models/',
                'Ecommerce\Admin\Forms'      => '../apps/admin/forms/',
                'Ecommerce\Admin\Helpers'      => '../apps/admin/helpers/',
                'Ecommerce\Loja\Helpers'      => '../apps/loja/helpers/',
            )
        );

        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices(DiInterface $di)
    {
        // Assign our new tag a definition so we can call it
        $di->set('Utilitarios', function () {
            return new \Ecommerce\Admin\Helpers\UtilitariosHelper();
        });
        
        $di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Ecommerce\Admin\Controllers');
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
            $view->setViewsDir('../apps/admin/views/');
            return $view;
        });

        include "../apps/admin/vendor/autoload.php";
    }
}