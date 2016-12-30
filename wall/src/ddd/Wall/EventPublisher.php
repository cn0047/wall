<?php

declare(strict_types = 1);

namespace Wall;

class EventPublisher
{
    /**
     * @var EventSubscriber[]
     */
    private $subscribers = [];

    /**
     * @var EventPublisher
     */
    private static $instance;

    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public function subscribe($subscriber)
    {
        $this->subscribers[] = $subscriber;
    }

    public function publish(EventInterface $event)
    {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->handle($event);
        }
    }
}
