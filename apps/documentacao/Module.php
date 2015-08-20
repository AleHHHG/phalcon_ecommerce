<?php

namespace Ecommerce\Documentacao;

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
    public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector = NULL)
    {

        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'Ecommerce\Documentacao\Controllers' => '../apps/documentacao/controllers/',
                'Ecommerce\Documentacao\Models'      => '../apps/documentacao/models/',
                'Ecommerce\Documentacao\Forms'      => '../apps/documentacao/forms/'
            )
        );
        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices(DiInterface $di)
    {

        $di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Ecommerce\Documentacao\Controllers');
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
            $view->setViewsDir('../apps/documentacao/views/');
            return $view;
        });
    }
}