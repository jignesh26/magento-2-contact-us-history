<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Test\Integration;

use Magento\Framework\Api\SearchCriteriaBuilder;
use PHPUnit\Framework\TestCase;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesRepositoryInterface;
use Magento\TestFramework\Helper\Bootstrap;
use VitaliyBoyko\ContactUsHistory\Api\ReplyProcessorInterface;

class ResponseOnNoteTest extends TestCase
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
     * @var ReplyProcessorInterface
     */
    private $reply;


    protected function setUp()
    {
        $this->notesRepository = Bootstrap::getObjectManager()->create(NotesRepositoryInterface::class);
        $this->searchCriteriaBuilder = Bootstrap::getObjectManager()->create(SearchCriteriaBuilder::class);
        $this->reply = Bootstrap::getObjectManager()->create(ReplyProcessorInterface::class);
    }

    /**
     * @magentoDataFixture ../../../../app/code/VitaliyBoyko/ContactUsHistory/Test/_files/notes.php
     */
    public function testChangeStatusOnResponseSent()
    {
        /** @var NoteInterface $note */
        $note = current(
            $this->notesRepository->getList(
                $this->searchCriteriaBuilder
                    ->addFilter('email', 'customer2@example.com')
                    ->create()
            )->getItems()
        );
        self::assertEquals(0, $note->getStatus());

        $params = [
            'note_id' => $note->getNoteId(),
            'message' => 'sample message'
        ];
        $this->reply->execute($params);

        /** @var NoteInterface $note */
        $note = current(
            $this->notesRepository->getList(
                $this->searchCriteriaBuilder
                    ->addFilter('email', 'customer2@example.com')
                    ->create()
            )->getItems()
        );
        self::assertEquals(1, $note->getStatus());
    }
}
