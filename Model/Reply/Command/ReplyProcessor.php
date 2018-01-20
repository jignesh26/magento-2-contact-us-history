<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model\Reply\Command;

use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesRepositoryInterface;
use VitaliyBoyko\ContactUsHistory\Api\ReplyProcessorInterface;
use VitaliyBoyko\ContactUsHistory\Model\MailInterface;
use VitaliyBoyko\ContactUsHistory\Model\Note\Command\ChangeNoteStatusService;

class ReplyProcessor implements ReplyProcessorInterface
{
    /**
     * @var NotesRepositoryInterface
     */
    private $notesRepository;
    /**
     * @var MailInterface
     */
    private $mail;
    /**
     * @var ChangeNoteStatusService
     */
    private $changeNoteStatusService;

    /**
     * @param NotesRepositoryInterface $notesRepository
     * @param MailInterface $mail
     * @param ChangeNoteStatusService $changeNoteStatusService
     */
    public function __construct(
        NotesRepositoryInterface $notesRepository,
        MailInterface $mail,
        ChangeNoteStatusService $changeNoteStatusService
    ) {
        $this->notesRepository = $notesRepository;
        $this->mail = $mail;
        $this->changeNoteStatusService = $changeNoteStatusService;
    }

    /**
     * @inheritdoc
     */
    public function execute($params)
    {
        $noteId = (int)$params['note_id'];
        /** @var NoteInterface $note */
        $note = $this->notesRepository->get($noteId);
        $this->mail->send($note->getEmail(), $params);
        $this->changeNoteStatusService->execute($noteId, 1);
    }
}
