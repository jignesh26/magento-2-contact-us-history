<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Model\ResourceModel\Note as NoteResourceModel;

class Note extends AbstractExtensibleModel implements NoteInterface
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(NoteResourceModel::class);
    }

    /**
     * @inheritdoc
     */
    public function getNoteId()
    {
        return $this->getData(self::NOTE_ID);
    }

    /**
     * @inheritdoc
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheritdoc
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritdoc
     */
    public function getContactName()
    {
        return $this->getData(self::CONTACT_NAME);
    }

    /**
     * @inheritdoc
     */
    public function setContactName($contactName)
    {
        return $this->setData(self::CONTACT_NAME, $contactName);
    }

    /**
     * @inheritdoc
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheritdoc
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @inheritdoc
     */
    public function getMessage()
    {
        return $this->getData(self::MESSAGE);
    }

    /**
     * @inheritdoc
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * @inheritdoc
     */
    public function getPhone()
    {
        return $this->getData(self::PHONE);
    }

    /**
     * @inheritdoc
     */
    public function setPhone($phone)
    {
        return $this->setData(self::PHONE, $phone);
    }
}
