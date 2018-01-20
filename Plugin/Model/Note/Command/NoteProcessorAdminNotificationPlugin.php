<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Plugin\Model\Note\Command;

use Magento\Framework\App\RequestInterface;
use VitaliyBoyko\ContactUsHistory\Api\NoteProcessorInterface;
use Magento\Framework\Notification\NotifierInterface as NotifierPool;

/**
 * Class provides admin notification after new note placed
 */
class NoteProcessorAdminNotificationPlugin
{
    /**
     * @var NotifierPool
     */
    private $notifier;
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @param NotifierPool $notifier
     * @param RequestInterface $request
     */
    public function __construct(
        NotifierPool $notifier,
        RequestInterface $request
    ) {
        $this->notifier = $notifier;
        $this->request = $request;
    }

    /**
     * @param NoteProcessorInterface $subject
     * @return void
     */
    public function afterExecute(NoteProcessorInterface $subject)
    {
        $customerName = $this->request->getParam('name');

        $this->notifier->addNotice(
            __('New note from contact form'),
            sprintf(__('Customer %s left note in contact form'), $customerName)
        );
    }
}
