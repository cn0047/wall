<?php

declare(strict_types = 1);

namespace Wall\Domain\Model\Message\Entity;

interface DAOInterface
{
    public function getById(int $vo): Message;
}
