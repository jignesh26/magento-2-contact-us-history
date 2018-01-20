<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Controller\Adminhtml\Note;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Inventory\Ui\Component\MassAction\Filter;
use VitaliyBoyko\ContactUsHistory\Api\NotesDeleteInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesRepositoryInterface;

/**
 * MassDelete Controller
 */
class MassDelete extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'VitaliyBoyko_ContactUsHistory::note';

    /**
     * @var Filter
     */
    private $massActionFilter;
    /**
     * @var NotesRepositoryInterface
     */
    private $notesRepository;
    /**
     * @var NotesDeleteInterface
     */
    private $notesDelete;

    /**
     * @param Context $context
     * @param NotesRepositoryInterface $notesRepository
     * @param NotesDeleteInterface $notesDelete
     * @param Filter $massActionFilter
     */
    public function __construct(
        Context $context,
        NotesRepositoryInterface $notesRepository,
        NotesDeleteInterface $notesDelete,
        Filter $massActionFilter
    ) {
        parent::__construct($context);
        $this->massActionFilter = $massActionFilter;
        $this->notesRepository = $notesRepository;
        $this->notesDelete = $notesDelete;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        if ($this->getRequest()->isPost() !== true) {
            $this->messageManager->addErrorMessage(__('Wrong request.'));

            return $this->resultRedirectFactory->create()->setPath('contactus/index/index');
        }

        $notes = [];
        foreach ($this->massActionFilter->getIds() as $id) {
            $notes[] = $this->notesRepository->get((int)$id);
        }

        $this->notesDelete->execute($notes);
        $this->messageManager->addSuccessMessage(__('You deleted %1 Note(s).', count($notes)));

        return $this->resultRedirectFactory->create()->setPath('contactus/index/index');
    }
}
