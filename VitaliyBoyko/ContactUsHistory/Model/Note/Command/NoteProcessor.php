<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model\Note\Command;

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
     * @param NoteInterfaceFactory $noteInterfaceFactory
     * @param NotesSaveInterface $notesSave
     */
    public function __construct(
        NoteInterfaceFactory $noteInterfaceFactory,
        NotesSaveInterface $notesSave
    ) {
        $this->noteInterfaceFactory = $noteInterfaceFactory;
        $this->notesSave = $notesSave;
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
                    NoteInterface::STATUS => 0
                ]
            ]
        );

        $this->notesSave->execute([$note]);
    }
}
