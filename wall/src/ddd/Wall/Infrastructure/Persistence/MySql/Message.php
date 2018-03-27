<?php

namespace Wall\Infrastructure\Persistence\MySql;

use Kernel\Di;
use Kernel\Exception\Di\ServiceInitMethodNotFoundException;
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
    /**
     * @param NewMessage $valueObject
     * @throws RuntimeInsertQueryException
     * @throws RuntimeSelectQueryException
     * @throws ServiceInitMethodNotFoundException
     * @return MessageDTO
     */
    public function save(NewMessage $valueObject): MessageDTO
    {
        /** @var \PDO $pdo */
        $pdo = Di::getInstance()->getService('mysql');

        $sth = $pdo->prepare('INSERT INTO message SET userId = :userId, message = :message');
        $sth->bindValue(':userId', $valueObject->getUserId(), \PDO::PARAM_STR);
        $sth->bindValue(':message', $valueObject->getMessage(), \PDO::PARAM_STR);
        if ($sth->execute()) {
            $id = $pdo->lastInsertId();
        } else {
            throw new RuntimeInsertQueryException($sth->errorInfo()[2]);
        }

        return $this->getMessageByIntId($id);
    }

    /**
     * @param int $valueObject
     * @return MessageEntity
     */
    public function getById(int $valueObject): MessageEntity
    {
        return new MessageEntity();
    }

    /**
     * @param string $id
     * @throws RuntimeSelectQueryException
     * @throws ServiceInitMethodNotFoundException
     * @return MessageDTO
     */
    private function getMessageByIntId(string $id): MessageDTO
    {
        /** @var \PDO $pdo */
        $pdo = Di::getInstance()->getService('mysql');

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

    /**
     * @param GetMessageById $valueObject
     * @throws RuntimeSelectQueryException
     * @throws ServiceInitMethodNotFoundException
     * @return MessageDTO
     */
    public function getMessageById(GetMessageById $valueObject): MessageDTO
    {
        return $this->getMessageByIntId($valueObject->getId());
    }

    /**
     * @param GetMessageByCriteria $valueObject
     * @throws RuntimeSelectQueryException
     * @throws ServiceInitMethodNotFoundException
     * @return array
     */
    public function getMessagesByCriteria(GetMessageByCriteria $valueObject): array
    {
        /** @var \PDO $pdo */
        $pdo = Di::getInstance()->getService('mysql');

        $limit = $valueObject->getLimit();
        $offset = $valueObject->getOffset();
        $sth = $pdo->prepare("
            SELECT id, userId, message, DATE_FORMAT(createdAt, '%d %b %y') AS createdAt
            FROM message
            ORDER BY id DESC
            LIMIT $offset, $limit
        ");
        $sth->setFetchMode(\PDO::FETCH_ASSOC);
        if (!$sth->execute()) {
            throw new RuntimeSelectQueryException($sth->errorInfo()[2]);
        }

        return $sth->fetchAll();
    }
}
