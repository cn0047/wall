<?php

declare(strict_types=1);

namespace Kernel;

class Di
{
    private static $config = [];

    private static $di = [];

    private static $persistences = [];

    private static $services = [];

    /**
     * @var Di $instance
     */
    private static $instance;

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public static function getInstance(): Di
    {
        if (self::$instance === null) {
            self::$config = require APP_DIR . '/src/app/config/config.php';
            self::$di = require APP_DIR . '/src/app/config/config.di.php';
            self::$instance = new static();
        }

        return self::$instance;
    }

    public static function getService(string $name)
    {
        if (!isset(self::$services[$name])) {
            $closure = self::$di[$name];
            self::$services[$name] = $closure();
        }

        return self::$services[$name];
    }

    public static function getConfig(string $name)
    {
        return self::$config[$name];
    }

    public static function getPersistence(string $name)
    {
        if (!isset(self::$persistences[$name])) {
            $persistence = self::getConfig('persistence')['default'];
            $className = "Wall\\Infrastructure\\Persistence\\$persistence\\" . ucfirst($name);
            self::$persistences[$name] = new $className();
        }

        return self::$persistences[$name];
    }
}
