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
     * @throws ConfigNotFoundException
     * @throws PersistenceNotFoundException
     */
    final public function __construct()
    {
        $this->init(Di::getInstance()->getPersistence('message'));
    }

    /**
     * @param MessageRepositoryInterface $repository
     */
    private function init(MessageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $userId
     * @param string $message
     * @throws \Kernel\Exception\Di\ConfigNotFoundException
     * @throws ValidationException
     * @throws PersistenceNotFoundException
     * @return MessageDTO
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
     * @param array $args
     * @throws ConfigNotFoundException
     * @throws PersistenceNotFoundException
     * @throws ValidationException
     * @return MessageDTO
     */
    public function createSimpleMessageFromArray(array $args): MessageDTO
    {
        return (new CreateNewMessage())->execute(new NewMessage($args));
    }

    /**
     * @param string $id
     * @throws ValidationException
     * @return MessageDTO
     */
    public function getMessageById(string $id): MessageDTO
    {
        $valueObject = new GetMessageById(['id' => $id]);

        return $this->repository->getMessageById($valueObject);
    }

    /**
     * @param GetMessageByCriteria $valueObject
     * @return array
     */
    public function getMessagesByCriteria(GetMessageByCriteria $valueObject): array
    {
        return $this->repository->getMessagesByCriteria($valueObject);
    }
}
