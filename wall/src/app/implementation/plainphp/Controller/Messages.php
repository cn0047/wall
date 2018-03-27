<?php

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
        $message = (new MessageService())->createSimpleMessage($_POST['userId'], $_POST['message']);

        return $this->returnJsonResponse(201, $message->toArray());
    }

    public function get(): Response
    {
        $valueObject = new GetMessageByCriteria($_GET);

        $collection = (new MessageService())->getMessagesByCriteria($valueObject);

        return $this->returnJsonResponse(200, $collection);
    }
}
