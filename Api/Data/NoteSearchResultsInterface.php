<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface NoteSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get notes
     *
     * @return NoteInterface[]
     */
    public function getItems();

    /**
     * Set notes
     *
     * @param NoteInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
