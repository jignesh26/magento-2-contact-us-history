<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Block\Adminhtml\Note\View;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Api\NotesRepositoryInterface;

class GenericButton
{
    /**
     * @var NotesRepositoryInterface
     */
    protected $notesRepository;
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @param NotesRepositoryInterface $notesRepository
     * @param RequestInterface $request
     * @param UrlInterface $url
     */
    public function __construct(
        NotesRepositoryInterface $notesRepository,
        RequestInterface $request,
        UrlInterface $url
    ) {
        $this->notesRepository = $notesRepository;
        $this->request = $request;
        $this->url = $url;
    }

    /**
     * Return note Id
     *
     * @return int|null
     */
    public function getNoteId()
    {
        $noteId = (int)$this->request->getParam(NoteInterface::NOTE_ID);
        /** @var NoteInterface $note */
        if ($noteId) {
            try {
                $note = $this->notesRepository->get($noteId);
                return $note->getNoteId();
            } catch (NoSuchEntityException $e) {
                return null;
            }
        }

        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->url->getUrl($route, $params);
    }
}
