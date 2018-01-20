<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteSearchResultsInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesRepositoryInterface;
use VitaliyBoyko\ContactUsHistory\Model\Note\Command\GetListInterface;

/**
 * @inheritdoc
 */
class NotesRepository implements NotesRepositoryInterface
{
    /**
     * @var GetListInterface
     */
    private $commandGetList;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param GetListInterface $commandGetList
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        GetListInterface $commandGetList,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->commandGetList = $commandGetList;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): NoteSearchResultsInterface
    {
        return $this->commandGetList->execute($searchCriteria);
    }

    /**
     * @inheritdoc
     */
    public function get($noteId): NoteInterface
    {
        /** @var SearchCriteriaInterface $searchCriteria */
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(NoteInterface::NOTE_ID, $noteId)
            ->create();
        $items =  $this->commandGetList->execute($searchCriteria)->getItems();
        if ($items) {
            return current($items);
        } else {
            throw new NoSuchEntityException();
        }
    }
}
