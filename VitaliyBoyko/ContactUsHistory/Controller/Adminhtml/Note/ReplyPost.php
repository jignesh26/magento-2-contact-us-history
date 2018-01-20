<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Controller\Adminhtml\Note;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Api\ReplyProcessorInterface;

class ReplyPost extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'VitaliyBoyko_ContactUsHistory::note';
    /**
     * @var ReplyProcessorInterface
     */
    private $replyProcessor;

    /**
     * @param Action\Context $context
     * @param ReplyProcessorInterface $replyProcessor
     */
    public function __construct(
        Action\Context $context,
        ReplyProcessorInterface $replyProcessor
    ) {
        parent::__construct($context);
        $this->replyProcessor = $replyProcessor;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $requestData = $this->getRequest()->getParams();
        $noteId = isset($requestData['general'][NoteInterface::NOTE_ID])
            ? (int)$requestData['general'][NoteInterface::NOTE_ID]
            : null;

        if ($noteId === null) {
            $this->messageManager->addErrorMessage(__('Wrong request.'));
            return $resultRedirect->setPath('*/*');
        }

        try {
            $this->replyProcessor->execute($requestData['general']);
            $this->messageManager->addSuccessMessage(__('Message has been sent'));
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
