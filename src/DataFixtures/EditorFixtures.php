<?php

namespace App\DataFixtures;

use App\Entity\Editor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EditorFixtures extends Fixture
{

    public const GALLIMARD = 'gallimard';
    public const MILAN = 'milan';
    public const HACHETTE = 'hachette';

    public function load(ObjectManager $manager)
    {
        $editor1 = new Editor();
        $editor1->setName('Gallimard');
        $editor1->setFoundationYear(1911);

        $editor2 = new Editor();
        $editor2->setName('Milan');
        $editor2->setFoundationYear(1980);

        $editor3 = new Editor();
        $editor3->setName('Hachette');
        $editor3->setFoundationYear(1826);

        $manager->persist($editor1);
        $manager->persist($editor2);
        $manager->persist($editor3);

        $this->addReference(self::GALLIMARD, $editor1);
        $this->addReference(self::MILAN, $editor2);
        $this->addReference(self::HACHETTE, $editor3);

        $manager->flush();
    }
}
