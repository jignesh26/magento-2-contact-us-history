<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Block\Adminhtml\Note\View;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class ReplyButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Reply'),
            'on_click' => sprintf("location.href = '%s';", $this->getReplyUrl()),
            'sort_order' => 40
        ];
    }

    /**
     * @return string
     */
    public function getReplyUrl()
    {
        return $this->getUrl('*/*/reply', ['note_id' => $this->getNoteId()]);
    }
}
