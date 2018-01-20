<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model\Note\Command;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Psr\Log\LoggerInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesSaveInterface;
use VitaliyBoyko\ContactUsHistory\Model\ResourceModel\Note\SaveMultiple;

/**
 * @inheritdoc
 */
class NotesSave implements NotesSaveInterface
{
    /**
     * @var SaveMultiple
     */
    private $saveMultiple;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param SaveMultiple $saveMultiple
     * @param LoggerInterface $logger
     */
    public function __construct(
        SaveMultiple $saveMultiple,
        LoggerInterface $logger
    ) {
        $this->saveMultiple = $saveMultiple;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function execute(array $notes)
    {
        if (empty($notes)) {
            throw new InputException(__('Input data is empty'));
        }

        try {
            $this->saveMultiple->execute($notes);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('Could not save notes'), $e);
        }
    }
}
