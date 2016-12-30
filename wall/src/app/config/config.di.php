<?php

declare(strict_types = 1);

use Kernel\Di;

return [
    'mysql' => function() {
        $mysqlConf = Di::getInstance()->getConfig('mysql');
        return new \PDO(
            sprintf('mysql:host=%s;dbname=%s', $mysqlConf['host'], $mysqlConf['dbname']),
            $mysqlConf['user'],
            $mysqlConf['password']
        );
    },
    'mongo' => function() {
    },
];
