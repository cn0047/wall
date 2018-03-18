<?php

namespace Wall\Domain\Model\Message\Event;

use Wall\EventInterface;
use Wall\Domain\Model\Message\DTO\Message as MessageDTO;

class MessageCreated implements EventInterface
{
    public function __construct(MessageDTO $dto)
    {
    }
}
