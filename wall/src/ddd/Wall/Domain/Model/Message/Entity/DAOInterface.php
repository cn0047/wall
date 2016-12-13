<?php

namespace Wall\Domain\Model\Message\Entity;

use Wall\Application\VO\Message\NewMessage;

interface DAOInterface
{
    public function save(NewMessage $message):int;
}
