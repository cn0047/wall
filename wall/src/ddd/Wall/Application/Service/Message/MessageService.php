<?php

namespace Wall\Application\Service\Message;

use Kernel\Di;
use Wall\Application\VO\Message\GetMessageByCriteria;
use Wall\Application\VO\Message\GetMessageById;
use Wall\Application\VO\Message\NewMessage;
use Wall\Domain\Model\Message\DTO\Message as MessageDTO;
use Wall\Domain\Service\CreateNewMessage;
use Wall\Domain\Model\Message\Entity\MessageRepositoryInterface;

class MessageService
{
    /**
     * @var MessageRepositoryInterface $repository
     */
    private $repository;

    final public function __construct()
    {
        $this->init(Di::getInstance()->getPersistence('message'));
    }

    final private function init(MessageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function createSimpleMessage(string $userId, string $message): MessageDTO
    {
        $vo = new NewMessage([
            'message' => $message,
            'userId' => $userId ?? '0',
        ]);

        return (new CreateNewMessage())->execute($vo);
    }

    public function getMessageById(string $id): MessageDTO
    {
        $vo = new GetMessageById(['id' => $id]);

        return $this->repository->getMessageById($vo);
    }

    public function getMessagesByCriteria(GetMessageByCriteria $vo): array
    {
        return $this->repository->getMessagesByCriteria($vo);
    }
}
