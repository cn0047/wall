<?php

namespace PlainPHP\Command;

use GuzzleHttp\Psr7\Response;
use Kernel\Exception\InvalidArgument\InvalidIdArgumentException;
use Kernel\Exception\InvalidArgument\InvalidMessageArgumentException;
use Wall\Application\Service\Message\MessageService;
use Wall\Application\VO\Message\NewMessage;
use Wall\Application\VO\Message\GetMessageById;

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

        $vo = new NewMessage([
            'userId' => $request[4] ?? '0',
            'message' => $request[3],
        ]);
        $message = (new MessageService())->createSimpleMessage($vo);

        return $this->returnJsonResponse(201, $message->toArray());
    }

    public function getById(array $request): Response
    {
        if (!isset($request[3])) {
            throw new InvalidIdArgumentException('You have to specify message id.');
        }

        $vo = new GetMessageById(['id' => $request[3]]);
        $message = (new MessageService())->getMessageById($vo);

        return $this->returnJsonResponse(200, $message->toArray());
    }

    public function get(array $request): Response
    {

    }
}
