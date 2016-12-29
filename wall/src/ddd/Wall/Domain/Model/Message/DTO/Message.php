<?php

declare(strict_types=1);

namespace Wall\Domain\Model\Message\DTO;

class Message
{
    private $id;

    private $userId;

    private $message;

    private $createdAt;

    public function __construct()
    {
        // In case when PDO fetch data from DB here in constructor we don't obtain data,
        // because PDO fulfill all necessary stuff under the hood.
        // Hence in this case we shouldn't do any actions.
        $args = func_get_args();
        if ($args === []) {
            return;
        }
        // But in case when we try to build DTO object explicitly,
        // we will obtain here array with properties which must be assigned.
        /** @var array $properties */
        $properties = $args[0];
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
