<?php

namespace Wall\Domain\Model\Message\Entity;

use Wall\Application\VO\Message\GetMessageById;
use Wall\Application\VO\Message\NewMessage;
use Wall\Domain\Model\Message\DTO\Message;

interface MessageRepositoryInterface extends DAOInterface
{
    public function getMessageById(GetMessageById $vo): Message;

    public function save(NewMessage $vo): Message;
}
