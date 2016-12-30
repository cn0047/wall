<?php

declare(strict_types = 1);

use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;

require_once __DIR__ . '/../../../bootstrap.php';

define('BASE_PATH', __DIR__ . '/../../app/implementation/phalcon');
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    $loader = new Loader();
    $loader->registerDirs([
        $config->application->controllersDir,
        $config->application->modelsDir
    ])->register();

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
