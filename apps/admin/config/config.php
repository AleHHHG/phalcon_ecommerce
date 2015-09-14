<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'application' => array(
        'controllersDir' => APP_PATH . '/apps/admin/controllers/',
        'modelsDir'      => APP_PATH . '/apps/admin/models/',
        'migrationsDir'  => APP_PATH . '/apps/admin/migrations/',
        'viewsDir'       => APP_PATH . '/apps/admin/views/',
        'pluginsDir'     => APP_PATH . '/apps/admin/plugins/',
        'libraryDir'     => APP_PATH . '/apps/admin/library/',
        'cacheDir'       => APP_PATH . '/apps/admin/cache/',
    )
));
