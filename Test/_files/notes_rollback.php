<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\TestFramework\Helper\Bootstrap;
use VitaliyBoyko\ContactUsHistory\Api\NotesDeleteInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesRepositoryInterface;

/** @var NotesRepositoryInterface $notesRepository */
$notesRepository = Bootstrap::getObjectManager()->get(NotesRepositoryInterface::class);
/** @var NotesDeleteInterface $notesDelete */
$notesDelete = Bootstrap::getObjectManager()->get(NotesDeleteInterface::class);
/** @var SearchCriteriaBuilder $searchCriteriaBuilder */
$searchCriteriaBuilder = Bootstrap::getObjectManager()->get(SearchCriteriaBuilder::class);

$notes = $notesRepository->getList($searchCriteriaBuilder->create())->getItems();
if ($notes) {
    $notesDelete->execute($notes);
}
