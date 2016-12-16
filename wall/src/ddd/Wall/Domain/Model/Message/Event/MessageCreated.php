<?php

declare(strict_types=1);

namespace Wall\Domain\Model\Message\Event;

use Wall\EventInterface;

class MessageCreated implements EventInterface
{
    public function __construct()
    {
    }
}
