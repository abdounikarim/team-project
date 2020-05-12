<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $php = new Category();
        $php->setName('php');
        $manager->persist($php);

        $html = new Category();
        $html->setName('html');
        $manager->persist($html);

        $javascript = new Category();
        $javascript->setName('javascript');
        $manager->persist($javascript);

        $manager->flush();
    }
}
