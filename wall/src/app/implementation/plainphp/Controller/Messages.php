<?php

declare(strict_types = 1);

namespace PlainPHP\Controller;

use GuzzleHttp\Psr7\Response;
use Wall\Application\Service\Message\MessageService;
use Wall\Application\VO\Message\GetMessageByCriteria;

class Messages
{
    private function returnJsonResponse(int $statusCode, array $array): Response
    {
        return new Response($statusCode, ['Content-Type' => 'application/json'], json_encode($array));
    }

    public function create(): Response
    {
        $message = (new MessageService())->createSimpleMessage(...array_values($_POST));

        return $this->returnJsonResponse(201, $message->toArray());
    }

    public function get(): Response
    {
        $vo = new GetMessageByCriteria($_GET);

        $collection = (new MessageService())->getMessagesByCriteria($vo);

        return $this->returnJsonResponse(200, $collection);
    }
}
