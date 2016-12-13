<?php

namespace PlainPHP\Foundation;

class Di
{
    private static $di = [];

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

    public static function getInstance():Di
    {
        if (static::$instance === null) {
            static::$di = require APP_DIR . '/src/app/implementation/plainphp/config.di.php';
            static::$instance = new static;
        }
        return static::$instance;
    }

    public static function get(string $name)
    {
        if (!isset(static::$services[$name])) {
            $closure = static::$di[$name];
            static::$services[$name] = $closure();
        }
        return static::$services[$name];
    }
}
