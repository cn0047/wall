<?php

$config = require APP_DIR . '/src/app/config/config.php';

return [
    'mysql' => function () use ($config) {
        $mysqlConf = $config['mysql'];
        return new \PDO(
            sprintf('mysql:host=%s;dbname=%s', $mysqlConf['host'], $mysqlConf['dbname']),
            $mysqlConf['user'],
            $mysqlConf['password']
        );
    },
    'mongo' => function () use ($config) {
    },
];
