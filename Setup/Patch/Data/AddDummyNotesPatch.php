<?php
/**
 * @author Atwix Team
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 */
declare(strict_types=1);

namespace VitaliyBoyko\ContactUsHistory\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use VitaliyBoyko\ContactUsHistory\Api\Command\SaveNotesInterface;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteDataInterface;
use VitaliyBoyko\ContactUsHistory\Api\Data\NoteDataInterfaceFactory;

/**
 * Dummy data
 */
class AddDummyNotesPatch implements DataPatchInterface, PatchVersionInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var NoteDataInterfaceFactory
     */
    private $noteDataInterfaceFactory;

    /**
     * @var SaveNotesInterface
     */
    private $saveNotes;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param NoteDataInterfaceFactory $noteDataInterfaceFactory
     * @param SaveNotesInterface $saveNotes
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        NoteDataInterfaceFactory $noteDataInterfaceFactory,
        SaveNotesInterface $saveNotes
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->noteDataInterfaceFactory = $noteDataInterfaceFactory;
        $this->saveNotes = $saveNotes;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $notes = [];
        foreach ($this->getNotesData() as $noteData) {
            $notes[] = $this->noteDataInterfaceFactory->create(
                ['data' => $noteData]
            );
        }
        $this->saveNotes->execute($notes);
    }

    /**
     * Australian states data.
     *
     * @return array
     */
    private function getNotesData()
    {
        return [
            [
                NoteDataInterface::EMAIL => 'test@test.com',
                NoteDataInterface::CONTACT_NAME => 'John Doe',
                NoteDataInterface::PHONE => '9379992',
                NoteDataInterface::MESSAGE => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                 sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quisque id diam vel
                 quam elementum pulvinar. Pulvinar neque laoreet suspendisse interdum consectetur libero 
                 id faucibus. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi.
                 Mauris ultrices eros in cursus turpis massa tincidunt dui ut. Sed euismod nisi porta lorem mollis. 
                 In fermentum posuere urna nec. Feugiat scelerisque varius morbi enim nunc faucibus a.
                 Ut consequat semper viverra nam libero justo laoreet sit. Neque gravida in fermentum et sollicitudin 
                ac orci phasellus. Varius morbi enim nunc faucibus. Volutpat est velit egestas dui id ornare arcu.
                Eget gravida cum sociis natoque penatibus et magnis dis parturient. Sem fringilla ut morbi
                tincidunt. Tincidunt augue interdum velit euismod. Arcu felis bibendum ut tristique et
                egestas. Consequat interdum varius sit amet mattis vulputate enim. Donec massa sapien faucibus
                 et molestie ac feugiat. Molestie a iaculis at erat pellentesque. Lectus nulla at volutpat diam
                 ut venenatis.',
                NoteDataInterface::CUSTOMER_ID => null
            ],
            [
                NoteDataInterface::EMAIL => 'test1@test.com',
                NoteDataInterface::CONTACT_NAME => 'Eric Lesser',
                NoteDataInterface::PHONE => '9379993',
                NoteDataInterface::MESSAGE => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                 sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quisque id diam vel
                 quam elementum pulvinar. Pulvinar neque laoreet suspendisse interdum consectetur libero 
                 id faucibus. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi.
                 Mauris ultrices eros in cursus turpis massa tincidunt dui ut. Sed euismod nisi porta lorem mollis. 
                 In fermentum posuere urna nec. Feugiat scelerisque varius morbi enim nunc faucibus a.
                 Ut consequat semper viverra nam libero justo laoreet sit. Neque gravida in fermentum et sollicitudin 
                ac orci phasellus. Varius morbi enim nunc faucibus. Volutpat est velit egestas dui id ornare arcu.
                Eget gravida cum sociis natoque penatibus et magnis dis parturient. Sem fringilla ut morbi
                tincidunt. Tincidunt augue interdum velit euismod. Arcu felis bibendum ut tristique et
                egestas. Consequat interdum varius sit amet mattis vulputate enim. Donec massa sapien faucibus
                 et molestie ac feugiat. Molestie a iaculis at erat pellentesque. Lectus nulla at volutpat diam
                 ut venenatis.',
                NoteDataInterface::CUSTOMER_ID => null
            ],
            [
                NoteDataInterface::EMAIL => 'test2@test.com',
                NoteDataInterface::CONTACT_NAME => 'Bob Seaman',
                NoteDataInterface::PHONE => '9379994',
                NoteDataInterface::MESSAGE => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                 sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quisque id diam vel
                 quam elementum pulvinar. Pulvinar neque laoreet suspendisse interdum consectetur libero 
                 id faucibus. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi.
                 Mauris ultrices eros in cursus turpis massa tincidunt dui ut. Sed euismod nisi porta lorem mollis. 
                 In fermentum posuere urna nec. Feugiat scelerisque varius morbi enim nunc faucibus a.
                 Ut consequat semper viverra nam libero justo laoreet sit. Neque gravida in fermentum et sollicitudin 
                ac orci phasellus. Varius morbi enim nunc faucibus. Volutpat est velit egestas dui id ornare arcu.
                Eget gravida cum sociis natoque penatibus et magnis dis parturient. Sem fringilla ut morbi
                tincidunt. Tincidunt augue interdum velit euismod. Arcu felis bibendum ut tristique et
                egestas. Consequat interdum varius sit amet mattis vulputate enim. Donec massa sapien faucibus
                 et molestie ac feugiat. Molestie a iaculis at erat pellentesque. Lectus nulla at volutpat diam
                 ut venenatis.',
                NoteDataInterface::CUSTOMER_ID => null
            ],
            [
                NoteDataInterface::EMAIL => 'test3@test.com',
                NoteDataInterface::CONTACT_NAME => 'Avril Khan',
                NoteDataInterface::PHONE => '9379995',
                NoteDataInterface::MESSAGE => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                 sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quisque id diam vel
                 quam elementum pulvinar. Pulvinar neque laoreet suspendisse interdum consectetur libero 
                 id faucibus. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi.
                 Mauris ultrices eros in cursus turpis massa tincidunt dui ut. Sed euismod nisi porta lorem mollis. 
                 In fermentum posuere urna nec. Feugiat scelerisque varius morbi enim nunc faucibus a.
                 Ut consequat semper viverra nam libero justo laoreet sit. Neque gravida in fermentum et sollicitudin 
                ac orci phasellus. Varius morbi enim nunc faucibus. Volutpat est velit egestas dui id ornare arcu.
                Eget gravida cum sociis natoque penatibus et magnis dis parturient. Sem fringilla ut morbi
                tincidunt. Tincidunt augue interdum velit euismod. Arcu felis bibendum ut tristique et
                egestas. Consequat interdum varius sit amet mattis vulputate enim. Donec massa sapien faucibus
                 et molestie ac feugiat. Molestie a iaculis at erat pellentesque. Lectus nulla at volutpat diam
                 ut venenatis.',
                NoteDataInterface::CUSTOMER_ID => null
            ],
            [
                NoteDataInterface::EMAIL => 'test4@test.com',
                NoteDataInterface::CONTACT_NAME => 'Emily Lee',
                NoteDataInterface::PHONE => '9379996',
                NoteDataInterface::MESSAGE => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                 sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quisque id diam vel
                 quam elementum pulvinar. Pulvinar neque laoreet suspendisse interdum consectetur libero 
                 id faucibus. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi.
                 Mauris ultrices eros in cursus turpis massa tincidunt dui ut. Sed euismod nisi porta lorem mollis. 
                 In fermentum posuere urna nec. Feugiat scelerisque varius morbi enim nunc faucibus a.
                 Ut consequat semper viverra nam libero justo laoreet sit. Neque gravida in fermentum et sollicitudin 
                ac orci phasellus. Varius morbi enim nunc faucibus. Volutpat est velit egestas dui id ornare arcu.
                Eget gravida cum sociis natoque penatibus et magnis dis parturient. Sem fringilla ut morbi
                tincidunt. Tincidunt augue interdum velit euismod. Arcu felis bibendum ut tristique et
                egestas. Consequat interdum varius sit amet mattis vulputate enim. Donec massa sapien faucibus
                 et molestie ac feugiat. Molestie a iaculis at erat pellentesque. Lectus nulla at volutpat diam
                 ut venenatis.',
                NoteDataInterface::CUSTOMER_ID => null
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '1.0.1';
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
