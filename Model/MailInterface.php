<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Model;

/**
 * @api
 */
interface MailInterface
{
    /**
     * Reply on email from contact form
     * @param string $to
     * @param array $variables Email template variables
     * @return void
     */
    public function send(string $to, array $variables);
}
