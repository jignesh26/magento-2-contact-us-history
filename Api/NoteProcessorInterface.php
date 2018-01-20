<?php
/**
 * @author Vitaliy Boyko <vitaliyboyko@i.ua>
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Api;

/**
 * Create new Note instanse form POST params
 *
 * @api
 */
interface NoteProcessorInterface
{
    /**
     * @param array $params
     * @return void
     */
    public function execute($params);
}
