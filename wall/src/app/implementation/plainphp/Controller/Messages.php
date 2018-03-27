<?php

namespace PlainPHP\Controller;

use GuzzleHttp\Psr7\Response;
use Kernel\Exception\Di\ConfigNotFoundException;
use Kernel\Exception\Di\PersistenceNotFoundException;
use ValueObject\Exception\ValidationException;
use Wall\Application\Service\Message\MessageService;
use Wall\Application\VO\Message\GetMessageByCriteria;

class Messages
{
    /**
     * @param int $statusCode
     * @param array $array
     * @return Response
     */
    private function returnJsonResponse(int $statusCode, array $array): Response
    {
        return new Response($statusCode, ['Content-Type' => 'application/json'], json_encode($array));
    }

    /**
     * @throws ConfigNotFoundException
     * @throws PersistenceNotFoundException
     * @throws ValidationException
     * @return Response
     */
    public function create(): Response
    {
        $message = (new MessageService())->createSimpleMessageFromArray($_POST);

        return $this->returnJsonResponse(201, $message->toArray());
    }

    /**
     * @throws ConfigNotFoundException
     * @throws PersistenceNotFoundException
     * @throws ValidationException
     * @return Response
     */
    public function get(): Response
    {
        $valueObject = new GetMessageByCriteria($_GET);

        $collection = (new MessageService())->getMessagesByCriteria($valueObject);

        return $this->returnJsonResponse(200, $collection);
    }
}
