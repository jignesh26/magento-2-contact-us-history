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

    /**
     * @inheritdoc
     */
    public function getCreatedDate()
    {
        return $this->getData(self::CREATED_DATE);
    }

    /**
     * @inheritdoc
     */
    public function setCreatedDate($createdDate)
    {
        return $this->setData(self::CREATED_DATE, $createdDate);
    }

    /**
     * @inheritdoc
     */
    public function getRepliedDate()
    {
        return $this->getData(self::REPLIED_DATE);
    }

    /**
     * @inheritdoc
     */
    public function setRepliedDate($repliedDate)
    {
        return $this->setData(self::REPLIED_DATE, $repliedDate);
    }

    /**
     * @inheritdoc
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @inheritdoc
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @inheritdoc
     */
    public function getIsRepliedFromAdmin()
    {
        return $this->getData(self::IS_REPLIED_FROM_ADMIN);
    }

    /**
     * @inheritdoc
     */
    public function setIsRepliedFromAdmin($isRepliedFromAdmin)
    {
        return $this->setData(self::IS_REPLIED_FROM_ADMIN, $isRepliedFromAdmin);
    }
}
