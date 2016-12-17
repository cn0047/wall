<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Persistence\Mongo;

use PlainPHP\Foundation\Di;
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
        // TODO: Implement getById() method.
        return new MessageEntity();
    }

    public function getMessageById(GetMessageById $vo): MessageDTO
    {
        // TODO: Implement getMessageById() method.
        return new MessageDTO([]);
    }

    public function save(NewMessage $vo): MessageDTO
    {
        // TODO: Implement save() method.
        return new MessageDTO([]);
    }

    public function getMessagesByCriteria(GetMessageByCriteria $vo): array
    {
        // TODO: Implement getMessagesByCriteria() method.
        return [];
    }
}
