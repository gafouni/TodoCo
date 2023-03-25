<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testDisplayLogin(){

        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'Connectez-vous');
    }


    public function testAuthenticationSuccess(){

        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form([
            'email'=>'valerie.guillet@gmail.com',
            'password'=>'password'
        ]);
        $client->submit($form); 

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        // $this->assertResponseRedirects('/');
        $client->followRedirect();


    }

    


}