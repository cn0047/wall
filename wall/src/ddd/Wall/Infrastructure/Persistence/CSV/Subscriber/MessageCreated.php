<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Persistence\CSV\Subscriber;

use Wall\EventInterface;
use Wall\EventSubscriber;

class MessageCreated implements EventSubscriber
{
    public function handle(EventInterface $event)
    {
        // Here we can perform some related stuff,
        // like create log or stats record in appropriate files.
    }
}
