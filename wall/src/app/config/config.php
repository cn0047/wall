<?php

$csv = require APP_DIR . '/src/app/config/config.csv.php';
$mysql = require APP_DIR . '/src/app/config/config.mysql.php';
$mongodb = require APP_DIR . '/src/app/config/config.mongodb.php';
$persistence = require APP_DIR . '/src/app/config/config.persistence.php';

$frontend = require APP_DIR . '/src/app/config/config.frontend.php';

return $csv + $mysql + $mongodb + $persistence + $frontend;
