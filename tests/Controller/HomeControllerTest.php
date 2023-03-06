<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase 
{
    public function testHomepagepath(){
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testHomepageContent() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertSame(1, $crawler->filter('h1')->count());

        $this->assertSelectorTextContains('h1', 'Bienvenue sur Todo List, l\'application vous permettant de gérer l\'ensemble de vos tâches sans effort !');
        
        $this->assertSelectorTextContains('a.btn.btn-info', 'Consulter la liste des tâches à faire');
        $this->assertSelectorTextContains('a.btn.btn-secondary', 'Consulter la liste des tâches terminées');
        $this->assertSelectorTextContains('a.btn.btn-success', 'Se connecter');
        


    }



}