<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //création des produits//
        // for ($i=0; $i<10; $i++){
        //     $product = new Product();
        // }

        $manager->flush();
    }
}
