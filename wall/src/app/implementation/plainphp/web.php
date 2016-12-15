
<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use ValueObject\Exception\ValidationException;

try {

    $controller = 'index';
    $action = 'index';

    if (isset($_SERVER['PATH_INFO'])) {
        switch ($_SERVER['PATH_INFO']) {
            case '/messages/get/':
                $controller = 'messages';
                $action = 'get';
                break;
            case '/messages/create/':
                $controller = 'messages';
                $action = 'create';
                break;
        }
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
