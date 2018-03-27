<?php

namespace Wall\Application\Service\Message;

use Kernel\Di;
use Kernel\Exception\Di\ConfigNotFoundException;
use Kernel\Exception\Di\PersistenceNotFoundException;
use ValueObject\Exception\ValidationException;
use Wall\Application\VO\Message\GetMessageByCriteria;
use Wall\Application\VO\Message\GetMessageById;
use Wall\Application\VO\Message\NewMessage;
use Wall\Domain\Model\Message\DTO\Message as MessageDTO;
use Wall\Domain\Model\Message\Entity\MessageRepositoryInterface;
use Wall\Domain\Service\CreateNewMessage;

class MessageService
{
    /**
     * @var MessageRepositoryInterface $repository
     */
    private $repository;

    /**
     * MessageService constructor.
     * @throws ConfigNotFoundException
     * @throws PersistenceNotFoundException
     */
    final public function __construct()
    {
        $this->init(Di::getInstance()->getPersistence('message'));
    }

    final private function init(MessageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $userId
     * @param string $message
     * @return MessageDTO
     * @throws ValidationException
     */
    public function createSimpleMessage(string $userId, string $message): MessageDTO
    {
        $valueObject = new NewMessage([
            'message' => $message,
            'userId' => $userId ?? '0',
        ]);

        return (new CreateNewMessage())->execute($valueObject);
    }

    /**
     * @param string $id
     * @return MessageDTO
     * @throws ValidationException
     */
    public function getMessageById(string $id): MessageDTO
    {
        $valueObject = new GetMessageById(['id' => $id]);

        return $this->repository->getMessageById($valueObject);
    }

    public function getMessagesByCriteria(GetMessageByCriteria $valueObject): array
    {
        return $this->repository->getMessagesByCriteria($valueObject);
    }
}
