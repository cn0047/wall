<?php

namespace Wall\Domain\Model\Message\Event;

use Wall\EventInterface;
use Wall\Domain\Model\Message\DTO\Message as MessageDTO;

class MessageCreated implements EventInterface
{
    private $dto;

    public function __construct(MessageDTO $dto)
    {
        $this->dto = $dto;
    }

    public function getDTO(): MessageDTO
    {
        return $this->dto;
    }
}
