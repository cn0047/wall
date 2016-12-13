<?php

$controller = 'index';
$action = 'index';

$className = "PlainPHP\\Controller\\" . ucfirst($controller);
$handler = new $className();
return $handler->$action();
