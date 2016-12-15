<?php

namespace Wall\Domain\Model\Message\DTO;

class Message
{
    private $id;

    private $userId;

    private $message;

    private $createdAt;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'message' => $this->message,
            'createdAt' => $this->createdAt,
        ];
    }
}
