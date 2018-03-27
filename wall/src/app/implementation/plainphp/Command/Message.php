<?php

namespace PlainPHP\Command;

use GuzzleHttp\Psr7\Response;
use Kernel\Exception\Di\ConfigNotFoundException;
use Kernel\Exception\Di\PersistenceNotFoundException;
use Kernel\Exception\InvalidArgument\InvalidIdArgumentException;
use Kernel\Exception\InvalidArgument\InvalidMessageArgumentException;
use ValueObject\Exception\ValidationException;
use Wall\Application\Service\Message\MessageService;
use Wall\Domain\Model\Message\DTO\Message as MessageDTO;

class Message
{
    /**
     * @param int $statusCode
     * @param MessageDTO $message
     * @return Response
     */
    private function returnJsonResponse(int $statusCode, MessageDTO $message): Response
    {
        return new Response($statusCode, ['Content-Type' => 'application/json'], json_encode($message->toArray()));
    }

    /**
     * @param array $request
     * @throws InvalidMessageArgumentException
     * @throws ConfigNotFoundException
     * @throws PersistenceNotFoundException
     * @throws ValidationException
     * @return Response
     */
    public function create(array $request): Response
    {
        if (!isset($request[3])) {
            throw new InvalidMessageArgumentException('You have to specify message text.');
        }

        $messageText = $request[3];
        $userId = $request[4] ?? '0';

        $messageService = new MessageService();
        $message = $messageService->createSimpleMessage($userId, $messageText);

        return $this->returnJsonResponse(201, $message);
    }

    /**
     * @param array $request
     * @throws InvalidIdArgumentException
     * @throws ConfigNotFoundException
     * @throws PersistenceNotFoundException
     * @throws ValidationException
     * @return Response
     */
    public function getById(array $request): Response
    {
        if (!isset($request[3])) {
            throw new InvalidIdArgumentException('You have to specify message id.');
        }

        return $this->returnJsonResponse(200, (new MessageService())->getMessageById($request[3]));
    }
}
