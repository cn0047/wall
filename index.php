<?php

// This script is here created especially for poor hosting providers.

if (php_sapi_name() === 'cli') {
    require_once __DIR__ . '/wall/src/bin/cli.php';
} else {
    require_once __DIR__ . '/wall/src/web/index.php';
}
