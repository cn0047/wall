<?php

namespace Kernel;

class Di
{
    private static $config = [];

    private static $persistences = [];

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
            static::$instance = new static;
        }
        return static::$instance;
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
