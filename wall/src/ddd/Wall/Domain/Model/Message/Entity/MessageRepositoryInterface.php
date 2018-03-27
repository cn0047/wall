<?php

namespace Wall\Domain\Model\Message\Entity;

use Wall\Application\VO\Message\GetMessageByCriteria;
use Wall\Application\VO\Message\GetMessageById;
use Wall\Application\VO\Message\NewMessage;
use Wall\Domain\Model\Message\DTO\Message;

interface MessageRepositoryInterface extends DAOInterface
{
    /**
     * @param GetMessageById $valueObject
     * @return Message
     */
    public function getMessageById(GetMessageById $valueObject): Message;

    /**
     * @param NewMessage $valueObject
     * @return Message
     */
    public function save(NewMessage $valueObject): Message;

    /**
     * @param GetMessageByCriteria $valueObject
     * @return array
     */
    public function getMessagesByCriteria(GetMessageByCriteria $valueObject): array;
}
