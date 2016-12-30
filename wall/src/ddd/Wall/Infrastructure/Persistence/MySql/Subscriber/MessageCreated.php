<?php

declare(strict_types = 1);

namespace Wall\Infrastructure\Persistence\MySql\Subscriber;

use Wall\EventInterface;
use Wall\EventSubscriber;

class MessageCreated implements EventSubscriber
{
    public function handle(EventInterface $event)
    {
        // Here we can perform some related stuff,
        // like create mysql log or stats record in appropriate db table.
    }
}
