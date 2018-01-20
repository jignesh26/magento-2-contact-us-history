<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model\Note\Command;

use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesRepositoryInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesSaveInterface;

class ChangeNoteStatusService
{
    /**
     * @var NotesRepositoryInterface
     */
    private $notesRepository;
    /**
     * @var NotesSaveInterface
     */
    private $notesSave;

    /**
     * @param NotesRepositoryInterface $notesRepository
     * @param NotesSaveInterface $notesSave
     */
    public function __construct(
        NotesRepositoryInterface $notesRepository,
        NotesSaveInterface $notesSave
    ) {
        $this->notesRepository = $notesRepository;
        $this->notesSave = $notesSave;
    }

    /**
     * @param int $noteId
     * @param int $status
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Validation\ValidationException
     */
    public function execute(int $noteId, int $status)
    {
        /** @var NoteInterface $note */
        $note = $this->notesRepository->get($noteId);
        $note->setStatus($status);

        $this->notesSave->execute([$note]);
    }
}
