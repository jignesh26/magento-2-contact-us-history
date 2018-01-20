<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model\Note\Command;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\InputException;
use VitaliyBoyko\ContactUsHistory\Api\NotesDeleteInterface;
use VitaliyBoyko\ContactUsHistory\Model\ResourceModel\Note\DeleteMultiple;
use Psr\Log\LoggerInterface;

/**
 * @inheritdoc
 */
class NotesDelete implements NotesDeleteInterface
{
    /**
     * @var DeleteMultiple
     */
    private $deleteMultiple;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param DeleteMultiple $deleteMultiple
     * @param LoggerInterface $logger
     */
    public function __construct(
        DeleteMultiple $deleteMultiple,
        LoggerInterface $logger
    ) {
        $this->deleteMultiple = $deleteMultiple;
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
            $this->deleteMultiple->execute($notes);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotDeleteException(__('Could not delete notes'), $e);
        }
    }
}
