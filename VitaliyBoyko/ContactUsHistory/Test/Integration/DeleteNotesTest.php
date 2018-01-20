<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Test\Integration;

use Magento\Framework\Api\SearchCriteriaBuilder;
use PHPUnit\Framework\TestCase;
use VitaliyBoyko\ContactUsHistory\Api\NotesDeleteInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesRepositoryInterface;
use Magento\TestFramework\Helper\Bootstrap;

class DeleteNotesTest extends TestCase
{
    /**
     * @var NotesRepositoryInterface
     */
    private $notesRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var NotesDeleteInterface
     */
    private $notesDelete;


    protected function setUp()
    {
        $this->notesRepository = Bootstrap::getObjectManager()->create(NotesRepositoryInterface::class);
        $this->searchCriteriaBuilder = Bootstrap::getObjectManager()->create(SearchCriteriaBuilder::class);
        $this->notesDelete = Bootstrap::getObjectManager()->create(NotesDeleteInterface::class);
    }

    /**
     * @magentoDataFixture ../../../../app/code/VitaliyBoyko/ContactUsHistory/Test/_files/notes.php
     */
    public function testDeleteNotes()
    {
        $notes = $this->notesRepository->getList($this->searchCriteriaBuilder->create())->getItems();
        self::assertEquals(3, count($notes));

        $this->notesDelete->execute([current($notes)]);

        $notes = $this->notesRepository->getList($this->searchCriteriaBuilder->create())->getItems();
        self::assertEquals(2, count($notes));
    }
}
