<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteSearchResultsInterface;

/**
 * @api
 */
interface NotesRepositoryInterface
{
    /**
     * Find Notes by SearchCriteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return NoteSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): NoteSearchResultsInterface;

    /**
     * @param $noteId
     * @return NoteInterface
     * @throws NoSuchEntityException
     */
    public function get($noteId): NoteInterface;
}
