<?php

declare(strict_types=1);

use Kernel\Di;

$mysqlConf = Di::getInstance()->getConfig('mysql');

return new \Phalcon\Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => $mysqlConf['host'],
        'username'    => $mysqlConf['user'],
        'password'    => $mysqlConf['password'],
        'dbname'      => $mysqlConf['dbname'],
        'charset'     => 'utf8',
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',

        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the webpspace.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri'        => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER['PHP_SELF']),
    ]
]);
