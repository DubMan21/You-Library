<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category1 = new Category();
        $category1->setName('Roman');
        $category1->setSlug('roman');

        $category2 = new Category();
        $category2->setName('Biographie');
        $category2->setSlug('biographie');

        $category3 = new Category();
        $category3->setName('Nouvelle');
        $category3->setSlug('nouvelle');

        $category4 = new Category();
        $category4->setName('Conte');
        $category4->setSlug('conte');

        $category5 = new Category();
        $category5->setName('Fable');
        $category5->setSlug('fable');

        $category6 = new Category();
        $category6->setName('Essai');
        $category6->setSlug('essai');

        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);
        $manager->persist($category4);
        $manager->persist($category5);
        $manager->persist($category6);

        $manager->flush();
    }
}
