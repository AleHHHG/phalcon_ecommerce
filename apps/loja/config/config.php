<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'application' => array(
        'controllersDir' => APP_PATH . '/apps/loja/controllers/',
        'modelsDir'      => APP_PATH . '/apps/loja/models/',
        'migrationsDir'  => APP_PATH . '/apps/loja/migrations/',
        'viewsDir'       => APP_PATH . '/apps/loja/views/',
        'pluginsDir'     => APP_PATH . '/apps/loja/plugins/',
        'libraryDir'     => APP_PATH . '/apps/loja/library/',
        'cacheDir'       => APP_PATH . '/apps/loja/cache/',
    )
));
