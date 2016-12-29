<?php

declare(strict_types=1);

$csv = require APP_DIR . '/src/app/config/csv.php';
$mysql = require APP_DIR . '/src/app/config/mysql.php';
$mongo = require APP_DIR . '/src/app/config/mongo.php';
$persistence = require APP_DIR . '/src/app/config/persistence.php';

$frontend = require APP_DIR . '/src/app/config/frontend.php';

return $csv + $mysql + $mongo + $persistence + $frontend;
