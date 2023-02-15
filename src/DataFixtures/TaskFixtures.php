<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Task;
use DateTimeImmutable;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

//class TaskFixtures extends Fixture 
class TaskFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        //création des taches//
        for ($i=0; $i<6; $i++){
           
            $task = new Task();
            $task->setTitle($faker->words(3, true))
                ->setContent($faker->paragraph(10, true))
                ->setCreatedAt(new DateTimeImmutable('now'))
              //  ->setIsDone($faker->numberBetween(0,1))
                //->setUser($this->getReference("anonyme"));
                ->setUser($this->getReference(UserFixtures::USER_REFERENCE));
            
            $manager->persist($task);    
            }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
