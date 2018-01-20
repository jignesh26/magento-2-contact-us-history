<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

use Magento\TestFramework\Helper\Bootstrap;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterface;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteInterfaceFactory;
use VitaliyBoyko\ContactUsHistory\Api\NotesSaveInterface;

/** @var NoteInterfaceFactory $noteFactory */
$noteFactory = Bootstrap::getObjectManager()->get(NoteInterfaceFactory::class);
/** @var NotesSaveInterface $notesSave */
$notesSave = Bootstrap::getObjectManager()->get(NotesSaveInterface::class);

$notesData = [
    [
        NoteInterface::CONTACT_NAME => 'Sample Name',
        NoteInterface::EMAIL => 'customer@example.com',
        NoteInterface::MESSAGE => 'Example message'
    ],
    [
        NoteInterface::CONTACT_NAME => 'Sample Name2',
        NoteInterface::EMAIL => 'customer2@example.com',
        NoteInterface::MESSAGE => 'Example message2'
    ],
    [
        NoteInterface::CONTACT_NAME => 'Sample Name3',
        NoteInterface::EMAIL => 'customer3@example.com',
        NoteInterface::MESSAGE => 'Example message3'
    ],
];
$notes = [];
foreach ($notesData as $noteData) {
    /** @var NoteInterface $note */
    $notes[] = $noteFactory->create([
        'data' => $noteData
    ]);
}

$notesSave->execute($notes);
