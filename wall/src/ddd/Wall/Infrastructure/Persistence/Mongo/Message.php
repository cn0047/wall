<?php

namespace Wall\Infrastructure\Persistence\Mongo;

use Wall\Application\VO\Message\GetMessageByCriteria;
use Wall\Application\VO\Message\GetMessageById;
use Wall\Application\VO\Message\NewMessage;
use Wall\Domain\Model\Message\DTO\Message as MessageDTO;
use Wall\Domain\Model\Message\Entity\DAOInterface;
use Wall\Domain\Model\Message\Entity\Message as MessageEntity;
use Wall\Domain\Model\Message\Entity\MessageRepositoryInterface;

class Message implements DAOInterface, MessageRepositoryInterface
{
    public function getById(int $vo): MessageEntity
    {
        return new MessageEntity();
    }

    public function getMessageById(GetMessageById $vo): MessageDTO
    {
        return new MessageDTO([]);
    }

    public function save(NewMessage $vo): MessageDTO
    {
        return new MessageDTO([]);
    }

    public function getMessagesByCriteria(GetMessageByCriteria $vo): array
    {
        return [];
    }
}
