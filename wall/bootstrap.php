<?php

declare(strict_types = 1);

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 'On');

define('APP_DIR', __DIR__);

// GLOBAL DI CONSTANTS.
// Here you can loosely change db storage or frontend implementation.
define('APP_PERSISTENCE', 'MySql'); // CSV | MySql | Mongo
define('APP_FRONTEND', 'react'); // jquery | react

require_once __DIR__ . '/vendor/autoload.php';
