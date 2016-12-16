<?php

declare(strict_types=1);

namespace Wall\Domain\Model\Message\DTO;

class Message
{
    private $id;

    private $userId;

    private $message;

    private $createdAt;

    public function __construct(array $properties)
    {
        foreach ($properties as $name => $value) {
            $this->$name = $value;
        }
    }

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
