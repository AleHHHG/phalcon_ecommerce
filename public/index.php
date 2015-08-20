<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));

try {

    /**
     * Read the configuration
     */
    $config = include APP_PATH . "/config/config.php";

    /**
     * Read services
     */
    include APP_PATH . "/config/services.php";

    $application = new \Phalcon\Mvc\Application($di);

    include APP_PATH . "/config/modules.php";

    /**
     * Handle the request
     */


    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
