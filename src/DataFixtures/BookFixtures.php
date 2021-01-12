<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $book1 = new Book();
        $book1->setTitle('Mon premier livre');
        $book1->setSlug('mon-premier-livre');
        $book1->setIsbn('1234567890000');
        $book1->setResume('Ce livre est le premier enregistré en base de donnée.');
        $book1->setPrice(10.99);
        $book1->setAuthor($this->getReference(AuthorFixtures::MAUPASSANT));
        $book1->addCategory($this->getReference(CategoryFixtures::BIOGRAPHIE));

        $book2 = new Book();
        $book2->setTitle('Symfony pour les nuls');
        $book2->setSlug('symfony-pour-les-nuls');
        $book2->setIsbn('1239890000');
        $book2->setResume("Tout ce qu'il y a à savoir sur Symfony");
        $book2->setPrice(30.04);
        $book2->setEditor($this->getReference(EditorFixtures::HACHETTE));
        $book2->setAuthor($this->getReference(AuthorFixtures::FLAUBERT));
        $book2->addCategory($this->getReference(CategoryFixtures::NOUVELLE));
        $book2->addCategory($this->getReference(CategoryFixtures::CONTE));

        $book3 = new Book();
        $book3->setTitle('Un essai');
        $book3->setSlug('un-essai');
        $book3->setIsbn('1239892330');
        $book3->setResume("Ce livre est un essai.");
        $book3->setPrice(30.04);
        $book3->setEditor($this->getReference(EditorFixtures::GALLIMARD));
        $book3->setAuthor($this->getReference(AuthorFixtures::MAUPASSANT));
        $book3->addCategory($this->getReference(CategoryFixtures::ESSAI));
        $book3->addCategory($this->getReference(CategoryFixtures::CONTE));

        $book4 = new Book();
        $book4->setTitle('Crossfit Games 2020');
        $book4->setSlug('crossfit-games-2020');
        $book4->setIsbn('4449892330');
        $book4->setResume("Tia Toomey et Matt Fraser resteront t-ils les leader cette année encore ?");
        $book4->setPrice(5.24);
        $book4->setEditor($this->getReference(EditorFixtures::MILAN));
        $book4->setAuthor($this->getReference(AuthorFixtures::MAUPASSANT));
        $book4->addCategory($this->getReference(CategoryFixtures::ESSAI));
        $book4->addCategory($this->getReference(CategoryFixtures::NOUVELLE));
        $book4->addCategory($this->getReference(CategoryFixtures::BIOGRAPHIE));
        $book4->addCategory($this->getReference(CategoryFixtures::CONTE));

        $book5 = new Book();
        $book5->setTitle('Un de plus');
        $book5->setSlug('un-de-plus');
        $book5->setIsbn('5559892330');
        $book5->setResume("C'est un peu long mais la bibliothèque sera bien fourni !");
        $book5->setPrice(12);
        $book5->setEditor($this->getReference(EditorFixtures::HACHETTE));
        $book5->setAuthor($this->getReference(AuthorFixtures::CAMUS));
        $book5->addCategory($this->getReference(CategoryFixtures::ESSAI));
        $book5->addCategory($this->getReference(CategoryFixtures::NOUVELLE));
        $book5->addCategory($this->getReference(CategoryFixtures::BIOGRAPHIE));
        $book5->addCategory($this->getReference(CategoryFixtures::CONTE));

        $book6 = new Book();
        $book6->setTitle("Allez c'est bientôt fini");
        $book6->setSlug('allez-c-est-bientot-fini');
        $book6->setIsbn('6669892330');
        $book6->setResume("On continu quoi...");
        $book6->setPrice(88);
        $book6->setEditor($this->getReference(EditorFixtures::MILAN));
        $book6->setAuthor($this->getReference(AuthorFixtures::CAMUS));
        $book6->addCategory($this->getReference(CategoryFixtures::NOUVELLE));
        $book6->addCategory($this->getReference(CategoryFixtures::BIOGRAPHIE));

        $manager->persist($book1);
        $manager->persist($book2);
        $manager->persist($book3);
        $manager->persist($book4);
        $manager->persist($book5);
        $manager->persist($book6);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            EditorFixtures::class,
            AuthorFixtures::class,
            CategoryFixtures::class
        );
    }
}
