<?php

namespace Wall\Infrastructure\Persistence\Mongo\Subscriber;

use Wall\EventInterface;
use Wall\EventSubscriber;

class MessageCreated implements EventSubscriber
{
    public function handle(EventInterface $event)
    {
        // Here we can perform some related stuff,
        // like create log or stats document in appropriate db collection.
    }
}
