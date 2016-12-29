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
        if (static::$instance === null) {
            static::$config = require APP_DIR . '/src/app/config/config.php';
            static::$di = require APP_DIR . '/src/app/config/config.di.php';
            static::$instance = new static();
        }

        return static::$instance;
    }

    public static function getService(string $name)
    {
        if (!isset(static::$services[$name])) {
            $closure = static::$di[$name];
            static::$services[$name] = $closure();
        }

        return static::$services[$name];
    }

    public static function getConfig(string $name)
    {
        return static::$config[$name];
    }

    public static function getPersistence(string $name)
    {
        if (!isset(static::$persistences[$name])) {
            $persistence = self::getConfig('persistence')['default'];
            $className = "Wall\\Infrastructure\\Persistence\\$persistence\\" . ucfirst($name);
            static::$persistences[$name] = new $className();
        }

        return static::$persistences[$name];
    }
}
