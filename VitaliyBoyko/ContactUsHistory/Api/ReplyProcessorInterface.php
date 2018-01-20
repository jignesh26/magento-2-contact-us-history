<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Api;

/**
 * Class allows to response on customer notes lived in contact form
 * by email and change note status from new to responded
 *
 * @api
 */
interface ReplyProcessorInterface
{
    /**
     * @param array $params
     * @return void
     */
    public function execute($params);
}
