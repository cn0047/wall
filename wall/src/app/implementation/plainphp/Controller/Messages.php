<?php

declare(strict_types=1);

namespace PlainPHP\Controller;

use GuzzleHttp\Psr7\Response;
use Kernel\Exception\InvalidArgument\InvalidIdArgumentException;
use Kernel\Exception\InvalidArgument\InvalidMessageArgumentException;
use Wall\Application\Service\Message\MessageService;
use Wall\Application\VO\Message\GetMessageByCriteria;
use Wall\Application\VO\Message\GetMessageById;
use Wall\Application\VO\Message\NewMessage;

class Messages
{
    private function returnJsonResponse(int $statusCode, array $array): Response
    {
        return new Response($statusCode, ['Content-Type' => 'application/json'], json_encode($array));
    }

    public function create(): Response
    {
        $vo = new NewMessage($_POST);
        $message = (new MessageService())->createSimpleMessage($vo);

        return $this->returnJsonResponse(201, $message->toArray());
    }

    public function get(): Response
    {
        $vo = new GetMessageByCriteria($_GET);

        $collection = (new MessageService())->getMessagesByCriteria($vo);

        return $this->returnJsonResponse(200, $collection);
    }
}
