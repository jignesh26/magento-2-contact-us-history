<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model\ResourceModel\Note;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use VitaliyBoyko\ContactUsHistory\Model\Note;
use VitaliyBoyko\ContactUsHistory\Model\ResourceModel\Note as NoteResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(Note::class, NoteResourceModel::class);
    }
}
