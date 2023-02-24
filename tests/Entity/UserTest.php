<?php

namespace App\tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase{

    public function testUser() {

        $user = new User();

        $user->setEmail('email');
        $user->setPassword('password');
        $user->setUsername('username');
        $user->setRoles(['roles']);

        $this->assertEquals("email", $user->getEmail());
        $this->assertEquals("password", $user->getPassword());
        $this->assertEquals("username", $user->getUsername());
        $this->assertEquals("roles", $user->getRoles());

    }
    





}