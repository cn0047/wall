<?php

declare(strict_types=1);

$mysql = require APP_DIR . '/src/app/config/mysql.php';
$mongo = require APP_DIR . '/src/app/config/mongo.php';
$persistence = require APP_DIR . '/src/app/config/persistence.php';

$csv = ['csv' => [
    'db' => APP_DIR . '/src/app/var/csv/db.csv',
]];

return $mysql + $mongo + $persistence + $csv;
