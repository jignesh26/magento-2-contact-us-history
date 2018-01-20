<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;

class Note extends AbstractDb
{
    /**
     * Table name
     */
    const TABLE_NAME_NOTES = 'contact_us_history';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME_NOTES, NoteInterface::NOTE_ID);
    }
}
