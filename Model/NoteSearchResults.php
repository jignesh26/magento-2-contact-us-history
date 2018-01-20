<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model;

use Magento\Framework\Api\SearchResults;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteSearchResultsInterface;

/**
 * @inheritdoc
 */
class NoteSearchResults extends SearchResults implements NoteSearchResultsInterface
{
}
