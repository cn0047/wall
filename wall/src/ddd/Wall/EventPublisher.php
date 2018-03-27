<?php

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

    /**
     * @return EventPublisher
     */
    public static function getInstance(): EventPublisher
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

    /**
     * @param $subscriber
     */
    public function subscribe($subscriber)
    {
        $this->subscribers[] = $subscriber;
    }

    /**
     * @param EventInterface $event
     */
    public function publish(EventInterface $event)
    {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->handle($event);
        }
    }
}
