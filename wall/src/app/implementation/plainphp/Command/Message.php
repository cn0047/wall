<?php

declare(strict_types=1);

namespace PlainPHP\Command;

use GuzzleHttp\Psr7\Response;
use Kernel\Exception\InvalidArgument\InvalidIdArgumentException;
use Kernel\Exception\InvalidArgument\InvalidMessageArgumentException;
use Wall\Application\Service\Message\MessageService;

class Message
{
    private function returnJsonResponse(int $statusCode, array $array): Response
    {
        return new Response($statusCode, ['Content-Type' => 'application/json'], json_encode($array));
    }

    public function create(array $request): Response
    {
        if (!isset($request[3])) {
            throw new InvalidMessageArgumentException('You have to specify message text.');
        }

        $message = (new MessageService())->createSimpleMessage($request[4] ?? '0', $request[3]);

        return $this->returnJsonResponse(201, $message->toArray());
    }

    public function getById(array $request): Response
    {
        if (!isset($request[3])) {
            throw new InvalidIdArgumentException('You have to specify message id.');
        }

        $message = (new MessageService())->getMessageById($request[3]);

        return $this->returnJsonResponse(200, $message->toArray());
    }
}
