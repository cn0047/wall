<?php

declare(strict_types=1);

namespace Wall\Infrastructure\FullTextSearching\ElasticSearch\Subscriber;

use Wall\EventInterface;
use Wall\EventSubscriber;

class MessageCreated implements EventSubscriber
{
    public function handle(EventInterface $event)
    {
        // Here we can put our user into ES index.
    }
}
