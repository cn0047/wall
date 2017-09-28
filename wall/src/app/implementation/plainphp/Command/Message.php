<?php

namespace PlainPHP\Command;

use GuzzleHttp\Psr7\Response;
use Kernel\Exception\InvalidArgument\InvalidIdArgumentException;
use Kernel\Exception\InvalidArgument\InvalidMessageArgumentException;
use Wall\Application\Service\Message\MessageService;
use Wall\Domain\Model\Message\DTO\Message as MessageDTO;

class Message
{
    private function returnJsonResponse(int $statusCode, MessageDTO $message): Response
    {
        return new Response($statusCode, ['Content-Type' => 'application/json'], json_encode($message->toArray()));
    }

    public function create(array $request): Response
    {
        if (!isset($request[3])) {
            throw new InvalidMessageArgumentException('You have to specify message text.');
        }

        $messageText = $request[3];
        $userId = $request[4] ?? '0';

        $ms = new MessageService();
        $message = $ms->createSimpleMessage($userId, $messageText);

        return $this->returnJsonResponse(201, $message);
    }

    public function getById(array $request): Response
    {
        if (!isset($request[3])) {
            throw new InvalidIdArgumentException('You have to specify message id.');
        }

        return $this->returnJsonResponse(200, (new MessageService())->getMessageById($request[3]));
    }
}
