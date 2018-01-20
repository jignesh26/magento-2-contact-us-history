<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Controller\Adminhtml\Note;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesDeleteInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesRepositoryInterface;

class Delete extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'VitaliyBoyko_ContactUsHistory::note';
    /**
     * @var NotesRepositoryInterface
     */
    private $notesRepository;
    /**
     * @var NotesDeleteInterface
     */
    private $notesDelete;

    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param NotesRepositoryInterface $notesRepository
     * @param NotesDeleteInterface $notesDelete
     */
    public function __construct(
        Action\Context $context,
        NotesRepositoryInterface $notesRepository,
        NotesDeleteInterface $notesDelete
    ) {
        parent::__construct($context);
        $this->notesRepository = $notesRepository;
        $this->notesDelete = $notesDelete;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $noteId = $this->getRequest()->getParam(NoteInterface::NOTE_ID);
        if ($noteId === null) {
            $this->messageManager->addErrorMessage(__('Wrong request.'));
            return $resultRedirect->setPath('*/*');
        }

        try {
            $note = $this->notesRepository->get($noteId);
            $this->notesDelete->execute([$note]);
            $this->messageManager->addSuccessMessage(__('The Note has been deleted.'));
            $resultRedirect->setPath('contactus/index/index');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $resultRedirect->setPath('contactus/note/view', [
                NoteInterface::NOTE_ID => $noteId,
                '_current' => true,
            ]);
        }

        return $resultRedirect;
    }
}
