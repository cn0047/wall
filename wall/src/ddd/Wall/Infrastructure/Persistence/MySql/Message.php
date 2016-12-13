<?php

namespace Wall\Infrastructure\Persistence\MySql;

use PlainPHP\Foundation\Di;
use Wall\Application\Exception\Persistence\RuntimeInsertQueryException;
use Wall\Application\VO\Message\NewMessage;
use Wall\Domain\Model\Message\Entity\DAOInterface;
use Wall\Domain\Model\Message\Entity\MessageRepositoryInterface;

class Message implements DAOInterface, MessageRepositoryInterface
{
    public function save(NewMessage $message):int
    {
        /** @var \PDO $pdo */
        $pdo = Di::getInstance()->get('mysql');
        $sth = $pdo->prepare('INSERT INTO message SET userId = :userId, message = :message');
        $sth->bindValue(':userId', $message->getUserId(), \PDO::PARAM_STR);
        $sth->bindValue(':message', $message->getMessage(), \PDO::PARAM_STR);
        if ($sth->execute()) {
            $id = $pdo->lastInsertId();
        } else {
            throw new RuntimeInsertQueryException($sth->errorInfo()[2]);
        }

        return $id;
    }
}
