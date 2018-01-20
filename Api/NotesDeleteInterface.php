<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Api;

use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;

/**
 * @api
 */
interface NotesDeleteInterface
{
    /**
     * Delete Multiple Note
     *
     * @param NoteInterface[] $notes
     * @return void
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function execute(array $notes);
}
