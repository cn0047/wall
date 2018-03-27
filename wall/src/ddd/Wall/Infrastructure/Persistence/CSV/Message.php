<?php

namespace Wall\Infrastructure\Persistence\CSV;

use Kernel\Di;
use Wall\Application\VO\Message\GetMessageByCriteria;
use Wall\Application\VO\Message\GetMessageById;
use Wall\Application\VO\Message\NewMessage;
use Wall\Domain\Model\Message\DTO\Message as MessageDTO;
use Wall\Domain\Model\Message\Entity\DAOInterface;
use Wall\Domain\Model\Message\Entity\Message as MessageEntity;
use Wall\Domain\Model\Message\Entity\MessageRepositoryInterface;

class Message implements DAOInterface, MessageRepositoryInterface
{
    private static $schema = ['id', 'userId', 'message', 'createdAt'];

    private $db = '';

    public function __construct()
    {
        $this->db = Di::getInstance()->getConfig('csv')['db'];
    }

    private function getNewId()
    {
        $file = $this->db . '.lastId';
        // Init id file.
        if (!file_exists($file)) {
            file_put_contents($file, '0');
        }
        // Increment id, because in id file we have last id.
        $id = (int)file_get_contents($file);
        $id++;
        // Save new id as last.
        file_put_contents($file, (string)$id);

        return $id;
    }

    public function save(NewMessage $valueObject): MessageDTO
    {
        $dto = new MessageDTO([
            'id' => $this->getNewId(),
            'userId' => $valueObject->getUserId(),
            'message' => str_replace("\n", '', nl2br(htmlspecialchars($vo->getMessage()))),
            'createdAt' => date('Y-m-d H:i:s'),
        ]);
        $fp = fopen($this->db, 'ab');
        fputcsv($fp, $dto->toArray());
        fclose($fp);

        $record = $dto->toArray();
        $record['createdAt'] = date('d M y', strtotime($record['createdAt']));

        return new MessageDTO($record);
    }

    public function getById(int $vo): MessageEntity
    {
        return new MessageEntity();
    }

    public function getMessageById(GetMessageById $vo): MessageDTO
    {
        // This is most efficient way to achieve desired aim!
        $command = sprintf("grep '^%s,' -Er %s", $vo->getId(), $this->db);
        $result = `$command`;

        return new MessageDTO(array_combine(self::$schema, str_getcsv($result)));
    }

    public function getMessagesByCriteria(GetMessageByCriteria $vo): array
    {
        $limit = (int)$vo->getLimit();
        $offset = (int)$vo->getOffset();
        // This is most efficient way to achieve desired aim!
        $command = sprintf('tac %s | head -n %d | tail -n %d', $this->db, $limit + $offset, $limit);
        $rawCsv = `$command`;
        $result = [];
        foreach (explode("\n", $rawCsv) as $rawCsvRecord) {
            if ($rawCsvRecord !== '') {
                $record = array_combine(self::$schema, str_getcsv($rawCsvRecord));
                $record['createdAt'] = date('d M y', strtotime($record['createdAt']));
                $result[] = $record;
            }
        }

        return $result;
    }
}
