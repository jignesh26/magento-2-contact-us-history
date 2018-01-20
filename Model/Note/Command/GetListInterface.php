<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model\Note\Command;

use Magento\Framework\Api\SearchCriteriaInterface;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteSearchResultsInterface;

/**
 * Find Notes by SearchCriteria command (Service Provider Interface - SPI)
 *
 * @api
 */
interface GetListInterface
{
    /**
     * Find Stocks by given SearchCriteria
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return NoteSearchResultsInterface
     */
    public function execute(SearchCriteriaInterface $searchCriteria): NoteSearchResultsInterface;
}
