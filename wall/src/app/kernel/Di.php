<?php

namespace Kernel;

use Kernel\Exception\Di\ConfigNotFoundException;
use Kernel\Exception\Di\PersistenceNotFoundException;
use Kernel\Exception\Di\ServiceInitMethodNotFoundException;

/**
 * Class Di (Dependency Injection Container).
 *
 * This class works by "lazy load" principle
 * and all elements will be initialized only in case when it really needed.
 *
 * To use this class you have to do something like this:
 *
 *     // get config:
 *     Di::getInstance()->getConfig('mysql');
 *
 *     // get service:
 *     Di::getInstance()->getService('mysql');
 *
 *     // get persistence (abstraction over db):
 *     Di::getInstance()->getPersistence('message');
 */
class Di
{
    /**
     * Instance of this class.
     *
     * @var Di $instance
     */
    private static $instance;

    /**
     * Container for all already initialized services.
     *
     * @var array $config
     */
    private static $config = [];

    /**
     * Container for all already initialized services.
     *
     * @var array $service
     */
    private static $service = [];

    /**
     * Container for all already initialized persistences (databases, storages, etc).
     *
     * @var array $persistence
     */
    private static $persistence = [];

    /**
     * Di constructor.
     *
     * This method overlapped intentionally with purpose to provide correct work of this singleton.
     */
    protected function __construct()
    {
    }

    /**
     * This method overlapped intentionally with purpose to provide correct work of this singleton.
     */
    protected function __clone()
    {
    }

    /**
     * Get instance (singleton) of this class.
     *
     * You have to start your interaction with DI by using this method.
     *
     * @return Di DI instance.
     */
    public static function getInstance(): Di
    {
        if (self::$instance === null) {
            self::$config = require APP_DIR . '/src/app/config/config.php';
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * Get config by name.
     *
     * @param string $name Config name.
     * @throws ConfigNotFoundException
     * @return mixed Config.
     */
    public static function getConfig(string $name)
    {
        if (!isset(self::$config[$name])) {
            throw new ConfigNotFoundException();
        }

        return self::$config[$name];
    }

    /**
     * Get service.
     *
     * All services will be created only when it needed,
     * and shared - each next call will use already created instance.
     *
     * @param string $name Shared service name.
     * @throws ServiceInitMethodNotFoundException
     * @return mixed Shared service instance.
     */
    public static function getService(string $name)
    {
        if (!isset(self::$service[$name])) {
            if (!method_exists(Init::class, $name)) {
                throw new ServiceInitMethodNotFoundException();
            }

            self::$service[$name] = Init::$name();
        }

        return self::$service[$name];
    }

    /**
     * Get persistence.
     *
     * Persistence - it's abstraction over databases or storage or something persistent.
     *
     * This method works with "Infrastructure DDD" layer
     * and returns persistence instance by its name.
     *
     * Behavior of this method determined by configuration which can be specified at runtime,
     * hence this method works like a gateway to persistence (MySql, MongoDB, etc).
     *
     * @param string $name Persistence name.
     * @throws ConfigNotFoundException
     * @throws PersistenceNotFoundException
     * @return mixed Persistence instance.
     */
    public static function getPersistence(string $name)
    {
        if (!isset(self::$persistence[$name])) {
            $persistence = self::getConfig('persistence')['default'];
            $className = "Wall\\Infrastructure\\Persistence\\$persistence\\" . ucfirst($name);

            if (!class_exists($className)) {
                throw new PersistenceNotFoundException();
            }

            self::$persistence[$name] = new $className();
        }

        return self::$persistence[$name];
    }
}
