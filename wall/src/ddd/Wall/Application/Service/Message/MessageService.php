<?php

namespace Wall\Application\Service\Message;

use Kernel\Di;
use Wall\Application\VO\Message\GetMessageById;
use Wall\Application\VO\Message\NewMessage;
use Wall\Domain\Model\Message\DTO\Message;
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

    public function createSimpleMessage(NewMessage $vo): Message
    {
        return $this->repository->save($vo);
    }

    public function getMessageById(GetMessageById $vo)
    {
        return $this->repository->getMessageById($vo);
    }
}
