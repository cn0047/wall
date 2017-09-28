<?php

namespace Wall;

interface EventSubscriber
{
    /**
     * @param EventInterface $event
     */
    public function handle(EventInterface $event);
}
