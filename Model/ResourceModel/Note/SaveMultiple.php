<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model\ResourceModel\Note;

use Magento\Framework\App\ResourceConnection;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Model\ResourceModel\Note;

class SaveMultiple
{
    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        ResourceConnection $resourceConnection
    ) {
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * Multiple save notes
     *
     * @param NoteInterface[] $notes
     * @return void
     */
    public function execute(array $notes)
    {
        if (!count($notes)) {
            return;
        }
        $connection = $this->resourceConnection->getConnection();
        $tableName = $this->resourceConnection->getTableName(Note::TABLE_NAME_NOTES);

        $columnsSql = $this->buildColumnsSqlPart([
            NoteInterface::NOTE_ID,
            NoteInterface::PHONE,
            NoteInterface::CONTACT_NAME,
            NoteInterface::STATUS,
            NoteInterface::MESSAGE,
            NoteInterface::EMAIL,
            NoteInterface::CREATED_DATE,
            NoteInterface::REPLIED_DATE,
            NoteInterface::CUSTOMER_ID,
            NoteInterface::IS_REPLIED_FROM_ADMIN
        ]);
        $valuesSql = $this->buildValuesSqlPart($notes);
        $onDuplicateSql = $this->buildOnDuplicateSqlPart([
            NoteInterface::PHONE,
            NoteInterface::CONTACT_NAME,
            NoteInterface::STATUS,
            NoteInterface::MESSAGE,
            NoteInterface::EMAIL,
            NoteInterface::CREATED_DATE,
            NoteInterface::REPLIED_DATE,
            NoteInterface::CUSTOMER_ID,
            NoteInterface::IS_REPLIED_FROM_ADMIN
        ]);
        $bind = $this->getSqlBindData($notes);

        $insertSql = sprintf(
            'INSERT INTO %s (%s) VALUES %s %s',
            $tableName,
            $columnsSql,
            $valuesSql,
            $onDuplicateSql
        );
        $connection->query($insertSql, $bind);
    }

    /**
     * @param array $columns
     * @return string
     */
    private function buildColumnsSqlPart(array $columns): string
    {
        $connection = $this->resourceConnection->getConnection();
        $processedColumns = array_map([$connection, 'quoteIdentifier'], $columns);
        $sql = implode(', ', $processedColumns);
        return $sql;
    }

    /**
     * @param NoteInterface[] $notes
     * @return string
     */
    private function buildValuesSqlPart(array $notes): string
    {
        $sql = rtrim(str_repeat('(?, ?, ?, ?, ?, ?, ?, ?, ?, ?), ', count($notes)), ', ');
        return $sql;
    }

    /**
     * @param NoteInterface[] $notes
     * @return array
     */
    private function getSqlBindData(array $notes): array
    {
        $bind = [];
        foreach ($notes as $note) {
            $bind = array_merge($bind, [
                $note->getNoteId(),
                $note->getPhone(),
                $note->getContactName(),
                $note->getStatus(),
                $note->getMessage(),
                $note->getEmail(),
                $note->getCreatedDate(),
                $note->getRepliedDate(),
                $note->getCustomerId(),
                $note->getIsRepliedFromAdmin()
            ]);
        }
        return $bind;
    }

    /**
     * @param array $fields
     * @return string
     */
    private function buildOnDuplicateSqlPart(array $fields): string
    {
        $connection = $this->resourceConnection->getConnection();
        $processedFields = [];
        foreach ($fields as $field) {
            $processedFields[] = sprintf('%1$s = VALUES(%1$s)', $connection->quoteIdentifier($field));
        }
        $sql = 'ON DUPLICATE KEY UPDATE ' . implode(', ', $processedFields);
        return $sql;
    }
}
