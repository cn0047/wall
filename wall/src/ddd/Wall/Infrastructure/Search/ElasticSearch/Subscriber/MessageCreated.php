<?php

namespace Wall\Infrastructure\Search\ElasticSearch\Subscriber;

use Wall\EventInterface;
use Wall\EventSubscriber;

class MessageCreated implements EventSubscriber
{
    /**
     * @param EventInterface $event
     */
    public function handle(EventInterface $event)
    {
        // Here we can put our user into ES index.

        var_export($event);
    }
}
