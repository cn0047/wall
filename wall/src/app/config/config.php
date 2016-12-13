<?php

$mysql = require APP_DIR . '/src/app/config/mysql.php';
$mongo = require APP_DIR . '/src/app/config/mongo.php';
$persistence = require APP_DIR . '/src/app/config/persistence.php';

return $mysql + $mongo + $persistence;
