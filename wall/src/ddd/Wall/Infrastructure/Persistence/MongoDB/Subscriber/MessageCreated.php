<?php

namespace Wall\Infrastructure\Persistence\MongoDB\Subscriber;

use Wall\EventInterface;
use Wall\EventSubscriber;

class MessageCreated implements EventSubscriber
{
    /**
     * @param EventInterface $event
     */
    public function handle(EventInterface $event)
    {
        // Here we can perform some related stuff,
        // like create log or stats document in appropriate db collection.
    }
}
