<?php

namespace App\DataFixtures;

use App\Entity\Author;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $author1 = new Author();
        $author1->setFirstname('Albert');
        $author1->setLastname('Camus');
        $author1->setBirthday(new DateTime(1913-11-07));

        $author2 = new Author();
        $author2->setFirstname('Gustave');
        $author2->setLastname('Flaubert');
        $author2->setBirthday(new DateTime(1821-12-12));

        $author3 = new Author();
        $author3->setFirstname('Guy');
        $author3->setLastname('de Maupassant');
        $author3->setBirthday(new DateTime(1850-07-05));

        $manager->persist($author1);
        $manager->persist($author2);
        $manager->persist($author3);

        $manager->flush();
    }
}
