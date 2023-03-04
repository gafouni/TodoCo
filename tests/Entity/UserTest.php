<?php

namespace App\tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase{

    public function testUser() {

        $user = new User();

        $user->setEmail('email');
        $user->setPassword('password');
        $user->setUsername('username');
        $user->setRoles(['ROLE_USER']);
        

        $this->assertEquals("email", $user->getEmail());
        $this->assertEquals("password", $user->getPassword());
        $this->assertEquals("username", $user->getUsername());
        $this->assertEquals(["ROLE_USER"], $user->getRoles());

    }


    

    







}