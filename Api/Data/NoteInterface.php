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
}
