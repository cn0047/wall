<?php

$config = require __DIR__ . '/config.php';

return [
    'mysql' => function () use ($config) {
        $mysqlConf = $config['mysql'];
        return new PDO(
            sprintf('mysql:host=%s;dbname=%s', $mysqlConf['host'], $mysqlConf['dbname']),
            $mysqlConf['user'],
            $mysqlConf['password']
        );
    },
];
