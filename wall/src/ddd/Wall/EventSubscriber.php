<?php

declare(strict_types=1);

namespace Wall;

interface EventSubscriber
{
    /**
     * @param EventInterface $event
     */
    public function handle(EventInterface $event);
}
