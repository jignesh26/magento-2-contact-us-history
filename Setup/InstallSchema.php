<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Model\ResourceModel\Note;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $noteTable = $setup->getTable(Note::TABLE_NAME_NOTES);

        $table = $setup->getConnection()->newTable(
            $noteTable
        )->setComment(
            'Notes history table'
        )->addColumn(
            NoteInterface::NOTE_ID,
            Table::TYPE_INTEGER,
            null,
            [
                Table::OPTION_IDENTITY => true,
                Table::OPTION_UNSIGNED => true,
                Table::OPTION_NULLABLE => false,
                Table::OPTION_PRIMARY => true,
            ],
            'Note ID'
        )->addColumn(
            NoteInterface::CONTACT_NAME,
            Table::TYPE_TEXT,
            255,
            [
                Table::OPTION_NULLABLE => false,
            ],
            'Contact Name'
        )->addColumn(
            NoteInterface::EMAIL,
            Table::TYPE_TEXT,
            255,
            [
                Table::OPTION_NULLABLE => false,
            ],
            'Email'
        )->addColumn(
            NoteInterface::PHONE,
            Table::TYPE_TEXT,
            255,
            [
                Table::OPTION_NULLABLE => true,
            ],
            'Phone number'
        )->addColumn(
            NoteInterface::MESSAGE,
            Table::TYPE_TEXT,
            null,
            [
                Table::OPTION_NULLABLE => false,
            ],
            'Message'
        )->addColumn(
            NoteInterface::STATUS,
            Table::TYPE_BOOLEAN,
            null,
            [
                Table::OPTION_NULLABLE => false,
            ],
            'Is replied'
        );

        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}
