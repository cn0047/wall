<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors','On');

define('APP_DIR', __DIR__);

// GLOBAL DI CONSTANTS.
define('APP_PERSISTENCE', 'CSV'); // CSV | MySql | Mongo
define('APP_FRONTEND', 'jquery'); // jquery | react

require_once __DIR__ . '/vendor/autoload.php';
