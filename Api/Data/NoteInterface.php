<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Api\Data;

interface NoteInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const NOTE_ID = 'note_id';
    const CONTACT_NAME = 'contact_name';
    const EMAIL = 'email';
    const STATUS = 'status';
    const MESSAGE = 'message';
    const PHONE = 'phone';
    const CREATED_DATE = 'created_date';
    const REPLIED_DATE = 'replied_date';
    const CUSTOMER_ID = 'customer_id';
    const IS_REPLIED_FROM_ADMIN = 'is_replied_from_admin';
    /**#@-*/

    /**
     * Get note id
     *
     * @return int
     */
    public function getNoteId();

    /**
     * Get note email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set note email
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email);

    /**
     * Get note contact name
     *
     * @return string
     */
    public function getContactName();

    /**
     * Set note contact name
     *
     * @param string $contactName
     * @return void
     */
    public function setContactName($contactName);

    /**
     * Check if admin replied on this note
     * For new entity should be false
     *
     * @return bool
     */
    public function getStatus();

    /**
     * Sets whether admin replied on note
     *
     * @param bool $status
     * @return void
     */
    public function setStatus($status);

    /**
     * Get note message
     *
     * @return string
     */
    public function getMessage();

    /**
     * Set note message
     *
     * @param string $message
     * @return void
     */
    public function setMessage($message);

    /**
     * Get note phone number
     *
     * @return string|null
     */
    public function getPhone();

    /**
     * Set note phone number
     *
     * @param string|null $phone
     * @return void
     */
    public function setPhone($phone);

    /**
     * Get created date
     *
     * @return string
     */
    public function getCreatedDate();

    /**
     * Set created date
     *
     * @param string $createdDate
     * @return void
     */
    public function setCreatedDate($createdDate);

    /**
     * Get replied date
     *
     * @return string|null
     */
    public function getRepliedDate();

    /**
     * Set replied date
     *
     * @param string|null $repliedDate
     * @return void
     */
    public function setRepliedDate($repliedDate);

    /**
     * Get customer id
     *
     * @return int|null
     */
    public function getCustomerId();

    /**
     * Set customer id
     *
     * @param int|null $customerId
     * @return void
     */
    public function setCustomerId($customerId);

    /**
     * Get is replied from admin
     *
     * @return bool|null
     */
    public function getIsRepliedFromAdmin();

    /**
     * Set is replied from admin
     *
     * @param bool|null $isRepliedFromAdmin
     * @return void
     */
    public function setIsRepliedFromAdmin($isRepliedFromAdmin);
}