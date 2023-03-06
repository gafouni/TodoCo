<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegistration(){

        $client = static::createClient();
        $client->request('GET', '/register');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'Inscrivez-vous');
    }


    public function testRegistrationSuccess(){

        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('Inscrivez-vous')->form([
            'username'=>'Thomas Daudet',
            'email'=>'thomas@todo.com',
            'password'=>'thomasdaudet'
        ]);
        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $this->assertResponseRedirects('/');
        $client->followRedirect();


    }

    


}