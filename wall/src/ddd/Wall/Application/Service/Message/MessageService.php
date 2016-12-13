<?php

namespace Wall\Application\Service\Message;

use Kernel\Di;
use Wall\Application\VO\Message\NewMessage;
use Wall\Domain\Model\Message\Entity\DAOInterface;

class MessageService
{
    /**
     * @var DAOInterface $repository
     */
    private $repository;

    final public function __construct()
    {
        $this->init(Di::getInstance()->getPersistence('message'));
    }

    final private function init(DAOInterface $repository)
    {
        $this->repository = $repository;
    }

    public function createSimpleMessage(NewMessage $vo):int
    {
        return $this->repository->save($vo);
    }
}