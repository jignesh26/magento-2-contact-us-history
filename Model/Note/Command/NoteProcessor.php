<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model\Note\Command;

use Magento\Customer\Model\Session;
use Magento\Framework\Stdlib\DateTime\DateTime;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterfaceFactory;
use VitaliyBoyko\ContactUsHistory\Api\NoteProcessorInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesSaveInterface;

/**
 * @inheritdoc
 */
class NoteProcessor implements NoteProcessorInterface
{
    /**
     * @var NoteInterfaceFactory
     */
    private $noteInterfaceFactory;

    /**
     * @var NotesSaveInterface
     */
    private $notesSave;

    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * @var Session
     */
    private $customerSession;

    /**
     * @param NoteInterfaceFactory $noteInterfaceFactory
     * @param NotesSaveInterface $notesSave
     * @param DateTime $dateTime
     * @param Session $customerSession
     */
    public function __construct(
        NoteInterfaceFactory $noteInterfaceFactory,
        NotesSaveInterface $notesSave,
        DateTime $dateTime,
        Session $customerSession
    ) {
        $this->noteInterfaceFactory = $noteInterfaceFactory;
        $this->notesSave = $notesSave;
        $this->dateTime = $dateTime;
        $this->customerSession = $customerSession;
    }

    /**
     * @inheritdoc
     */
    public function execute($params)
    {
        $note = $this->noteInterfaceFactory->create(
            [
                'data' => [
                    NoteInterface::EMAIL => $params['email'],
                    NoteInterface::CONTACT_NAME => $params['name'],
                    NoteInterface::PHONE => $params['telephone'],
                    NoteInterface::MESSAGE => $params['comment'],
                    NoteInterface::STATUS => 0,
                    NoteInterface::CREATED_DATE => $this->dateTime->gmtDate(),
                    NoteInterface::CUSTOMER_ID => $this->customerSession->getCustomerId()
                ]
            ]
        );
        $this->notesSave->execute([$note]);
    }
}
