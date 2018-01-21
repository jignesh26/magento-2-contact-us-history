<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Controller\Adminhtml\Note;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Model\Note\Command\ChangeNoteStatusService;

/**
 * Class Save provide saving OrderInterface::STATUS field
 * all other data will not be changed
 */
class Save extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'VitaliyBoyko_ContactUsHistory::note';
    /**
     * @var ChangeNoteStatusService
     */
    private $changeNoteStatusService;

    /**
     * @param Action\Context $context
     * @param ChangeNoteStatusService $changeNoteStatusService
     */
    public function __construct(
        Action\Context $context,
        ChangeNoteStatusService $changeNoteStatusService
    ) {
        parent::__construct($context);
        $this->changeNoteStatusService = $changeNoteStatusService;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $requestData = $this->getRequest()->getParams();
        $noteId = isset($requestData[NoteInterface::NOTE_ID])
            ? (int)$requestData[NoteInterface::NOTE_ID]
            : null;

        if ($noteId === null) {
            $this->messageManager->addErrorMessage(__('Wrong request.'));
            return $resultRedirect->setPath('*/*');
        }

        try {
            $noteStatus = (int)$requestData[NoteInterface::STATUS];
            $this->changeNoteStatusService->execute($noteId, $noteStatus);
            $this->messageManager->addSuccessMessage(__('The Note has been saved.'));
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
