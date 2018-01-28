<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model\Note\Command;

use Magento\Framework\Stdlib\DateTime\DateTime;
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
     * @var DateTime
     */
    private $dateTime;

    /**
     * @param NotesRepositoryInterface $notesRepository
     * @param NotesSaveInterface $notesSave
     * @param DateTime $dateTime
     */
    public function __construct(
        NotesRepositoryInterface $notesRepository,
        NotesSaveInterface $notesSave,
        DateTime $dateTime
    ) {
        $this->notesRepository = $notesRepository;
        $this->notesSave = $notesSave;
        $this->dateTime = $dateTime;
    }

    /**
     * @param int $noteId
     * @param int $status
     * @param bool $isRepliedFromAdmin
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Validation\ValidationException
     */
    public function execute(int $noteId, int $status, bool $isRepliedFromAdmin = false)
    {
        /** @var NoteInterface $note */
        $note = $this->notesRepository->get($noteId);
        $note->setStatus($status);
        if ($isRepliedFromAdmin) {
            $note->setIsRepliedFromAdmin($isRepliedFromAdmin);
            $note->setRepliedDate($this->dateTime->gmtDate());
        }

        $this->notesSave->execute([$note]);
    }
}
