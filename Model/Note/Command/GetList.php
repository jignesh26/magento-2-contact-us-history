<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model\Note\Command;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteSearchResultsInterface;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteSearchResultsInterfaceFactory;
use VitaliyBoyko\ContactUsHistory\Model\ResourceModel\Note\Collection;
use VitaliyBoyko\ContactUsHistory\Model\ResourceModel\Note\CollectionFactory;

/**
 * @inheritdoc
 */
class GetList implements GetListInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var CollectionFactory
     */
    private $noteCollectionFactory;

    /**
     * @var NoteSearchResultsInterfaceFactory
     */
    private $noteSearchResultsFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param CollectionProcessorInterface $collectionProcessor
     * @param CollectionFactory $noteCollectionFactory
     * @param NoteSearchResultsInterfaceFactory $noteSearchResultsFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $noteCollectionFactory,
        NoteSearchResultsInterfaceFactory $noteSearchResultsFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->collectionProcessor = $collectionProcessor;
        $this->noteCollectionFactory = $noteCollectionFactory;
        $this->noteSearchResultsFactory = $noteSearchResultsFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritdoc
     */
    public function execute(SearchCriteriaInterface $searchCriteria): NoteSearchResultsInterface
    {
        /** @var Collection $collection */
        $collection = $this->noteCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var NoteSearchResultsInterface $searchResult */
        $searchResult = $this->noteSearchResultsFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);
        return $searchResult;
    }
}
