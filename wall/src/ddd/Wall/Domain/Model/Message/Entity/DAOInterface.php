<?php

namespace Wall\Domain\Model\Message\Entity;

interface DAOInterface
{
    /**
     * @param int $valueObject
     * @return Message
     */
    public function getById(int $valueObject): Message;
}
