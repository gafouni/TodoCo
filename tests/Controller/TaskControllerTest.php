<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/task/list');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('.btn-info');
        //$this->assertSelectorTextContains('h1', 'Hello World');
    }
}
