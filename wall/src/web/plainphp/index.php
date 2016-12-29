<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use ValueObject\Exception\ValidationException;

require_once __DIR__ .'/../../../bootstrap.php';

try {

    $controller = 'index';
    $action = 'index';

    $route = parse_url($_SERVER['REQUEST_URI'])['path'];
    switch ($route) {
        case '/messages/get/':
            $controller = 'messages';
            $action = 'get';
            break;
        case '/messages/create/':
            $controller = 'messages';
            $action = 'create';
            break;
    }

    $className = "PlainPHP\\Controller\\" . ucfirst($controller);
    $handler = new $className();
    /** @var Response $response */
    $response = $handler->$action();

    print $response->getBody();

} catch (ValidationException $e) {
    header('HTTP/1.0 400 Bad Request');
    print json_encode($e->getJoinedMessages());
}
