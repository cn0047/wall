<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Persistence\MySql;

use PlainPHP\Foundation\Di;
use Wall\Application\Exception\Persistence\RuntimeInsertQueryException;
use Wall\Application\Exception\Persistence\RuntimeSelectQueryException;
use Wall\Application\VO\Message\GetMessageByCriteria;
use Wall\Application\VO\Message\GetMessageById;
use Wall\Application\VO\Message\NewMessage;
use Wall\Domain\Model\Message\DTO\Message as MessageDTO;
use Wall\Domain\Model\Message\Entity\DAOInterface;
use Wall\Domain\Model\Message\Entity\Message as MessageEntity;
use Wall\Domain\Model\Message\Entity\MessageRepositoryInterface;

class Message implements DAOInterface, MessageRepositoryInterface
{
    public function save(NewMessage $vo): MessageDTO
    {
        /** @var \PDO $pdo */
        $pdo = Di::getInstance()->get('mysql');

        $sth = $pdo->prepare('INSERT INTO message SET userId = :userId, message = :message');
        $sth->bindValue(':userId', $vo->getUserId(), \PDO::PARAM_STR);
        $sth->bindValue(':message', $vo->getMessage(), \PDO::PARAM_STR);
        if ($sth->execute()) {
            $id = $pdo->lastInsertId();
        } else {
            throw new RuntimeInsertQueryException($sth->errorInfo()[2]);
        }

        return $this->getMessageByIntId($id);
    }

    public function getById(int $vo): MessageEntity
    {
        return new MessageEntity();
    }

    private function getMessageByIntId(string $id): MessageDTO
    {
        /** @var \PDO $pdo */
        $pdo = Di::getInstance()->get('mysql');

        $sth = $pdo->prepare("
            SELECT id, userId, message, DATE_FORMAT(createdAt, '%d %b %y') AS createdAt
            FROM message
            WHERE id = :id
        ");
        $sth->bindParam(':id', $id, \PDO::PARAM_STR);
        $sth->setFetchMode(\PDO::FETCH_CLASS, MessageDTO::class);
        if (!$sth->execute()) {
            throw new RuntimeSelectQueryException($sth->errorInfo()[2]);
        }

        return $sth->fetch();
    }

    public function getMessageById(GetMessageById $vo): MessageDTO
    {
        return $this->getMessageByIntId($vo->getId());
    }

    public function getMessagesByCriteria(GetMessageByCriteria $vo): array
    {
        /** @var \PDO $pdo */
        $pdo = Di::getInstance()->get('mysql');

        $limit = $vo->getLimit();
        $offset = $vo->getOffset();
        $sth = $pdo->prepare("
            SELECT id, userId, message, DATE_FORMAT(createdAt, '%d %b %y') AS createdAt
            FROM message
            ORDER BY createdAt ASC
            LIMIT $offset, $limit
        ");
        $sth->setFetchMode(\PDO::FETCH_ASSOC);
        if (!$sth->execute()) {
            throw new RuntimeSelectQueryException($sth->errorInfo()[2]);
        }

        return $sth->fetchAll();
    }
}
