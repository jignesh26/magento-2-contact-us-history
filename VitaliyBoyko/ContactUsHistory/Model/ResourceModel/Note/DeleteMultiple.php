<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model\ResourceModel\Note;

use Magento\Framework\App\ResourceConnection;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Model\ResourceModel\Note;

/**
 * Implementation of Notes delete multiple operation for specific db layer
 */
class DeleteMultiple
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
     * Multiple delete notes
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

        $whereSql = $this->buildWhereSqlPart($notes);
        $connection->delete($tableName, $whereSql);
    }

    /**
     * @param NoteInterface[] $notes
     * @return string
     */
    private function buildWhereSqlPart(array $notes): string
    {
        $connection = $this->resourceConnection->getConnection();

        $condition = [];
        foreach ($notes as $note) {
            $condition[] = $connection->quoteInto(
                NoteInterface::NOTE_ID . ' = ?',
                $note->getNoteId()
            );
        }
        return implode(' OR ', $condition);
    }
}
