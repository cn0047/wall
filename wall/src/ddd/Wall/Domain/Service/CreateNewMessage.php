<?php

namespace Wall\Domain\Service;

use Kernel\Di;
use Kernel\Exception\Di\ConfigNotFoundException;
use Kernel\Exception\Di\PersistenceNotFoundException;
use Wall\Application\VO\Message\NewMessage;
use Wall\Domain\Model\Message\DTO\Message as MessageDTO;
use Wall\Domain\Model\Message\Entity\MessageRepositoryInterface;
use Wall\Domain\Model\Message\Event\MessageCreated as MessageCreatedEvent;
use Wall\EventPublisher;
use Wall\Infrastructure\Search\ElasticSearch\Subscriber\MessageCreated as ESSubscriber;
use Wall\Infrastructure\Persistence\MySql\Subscriber\MessageCreated as MySqlSubscriber;

class CreateNewMessage
{
    /**
     * @var MessageRepositoryInterface $repository
     */
    private $repository;

    /**
     * @throws ConfigNotFoundException
     * @throws PersistenceNotFoundException
     */
    final public function __construct()
    {
        $this->init(Di::getInstance()->getPersistence('message'));

        EventPublisher::getInstance()->subscribe(new MySqlSubscriber());
        EventPublisher::getInstance()->subscribe(new ESSubscriber());
    }

    /**
     * @param MessageRepositoryInterface $repository
     */
    private function init(MessageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param NewMessage $valueObject
     * @return MessageDTO
     */
    public function execute(NewMessage $valueObject): MessageDTO
    {
        $dto = $this->repository->save($valueObject);

        EventPublisher::getInstance()->publish(new MessageCreatedEvent($dto));

        return $dto;
    }
}
