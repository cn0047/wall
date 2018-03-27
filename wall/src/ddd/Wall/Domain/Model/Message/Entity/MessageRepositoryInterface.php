<?php

namespace Wall\Domain\Model\Message\Entity;

use Wall\Application\VO\Message\GetMessageByCriteria;
use Wall\Application\VO\Message\GetMessageById;
use Wall\Application\VO\Message\NewMessage;
use Wall\Domain\Model\Message\DTO\Message;

interface MessageRepositoryInterface extends DAOInterface
{
    public function getMessageById(GetMessageById $valueObject): Message;

    public function save(NewMessage $valueObject): Message;

    public function getMessagesByCriteria(GetMessageByCriteria $valueObject): array;
}
