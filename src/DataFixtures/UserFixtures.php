<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $userPasswordHasher;

    public const USER_REFERENCE = "anonyme";

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }    

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        //création des utilisateurs//
        for ($i=0; $i<6; $i++){
           
            $user = new User();
            $user->setEmail($faker->email)
                ->setPassword($this->userPasswordHasher->hashPassword($user, "password"))
                ->setRoles(["ROLE_USER"])
                ->setUsername($faker->words(2, true));
            //$this->addReference('anonyme', $user); 
            // $this->addReference(self::USER_REFERENCE, $user); 
            
            $manager->persist($user);   
            //$this->addReference(self::USER_REFERENCE, $user); 
            }

        $manager->flush();
        $this->addReference(self::USER_REFERENCE, $user); 

    }
}
