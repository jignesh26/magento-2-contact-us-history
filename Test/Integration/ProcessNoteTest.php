<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Test\Integration;

use Magento\Framework\Api\SearchCriteriaBuilder;
use PHPUnit\Framework\TestCase;
use Magento\TestFramework\Helper\Bootstrap;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Api\NoteProcessorInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesRepositoryInterface;

class ProcessNoteTest extends TestCase
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
     * @var NoteProcessorInterface
     */
    private $noteProcessor;


    protected function setUp()
    {
        $this->notesRepository = Bootstrap::getObjectManager()->create(NotesRepositoryInterface::class);
        $this->searchCriteriaBuilder = Bootstrap::getObjectManager()->create(SearchCriteriaBuilder::class);
        $this->noteProcessor = Bootstrap::getObjectManager()->create(NoteProcessorInterface::class);
    }

    /**
     * @magentoDataFixture ../../../../app/code/VitaliyBoyko/ContactUsHistory/Test/_files/notes.php
     */
    public function testCreateNewNote()
    {
        $notes = $this->notesRepository->getList($this->searchCriteriaBuilder->create())->getItems();
        self::assertEquals(3, count($notes));

        $this->noteProcessor->execute([
            'name' => 'Sample Name3',
            'email' => 'customer3@example.com',
            'comment' => 'Example message3',
            'telephone' => '000-000-00'
        ]);

        $notes = $this->notesRepository->getList($this->searchCriteriaBuilder->create())->getItems();
        self::assertEquals(4, count($notes));

        /** @var NoteInterface $note */
        $note = current(
            $this->notesRepository->getList(
                $this->searchCriteriaBuilder
                    ->addFilter('email', 'customer3@example.com')
                    ->create()
            )->getItems()
        );
        self::assertEquals(0, $note->getStatus());
    }
}
