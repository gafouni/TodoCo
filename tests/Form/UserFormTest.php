<?php

namespace App\tests\Form;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserFormTest extends WebTestCase 
{

    public function loginAdmin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        
        $form = $crawler->selectButton('Connectez-vous')->form([
            'email' => 'jr@list.com',
            'password' => '$2y$13$gOZV4ma74IN4N28FCOdMv.iwrjYH6sEfyLVs32Lf.wo6xrJn9JQne'
        ]);

        $client->submit($form);

        return $client;

    }    

    public function testCreateTaskForm(): void {

        // $client = static::createClient();
        $client = $this->loginAdmin();

        $crawler = $client->request('GET', '/users/create');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('label', 'Adresse mail' );

        //Recuperation du formulaire
        $submitButton = $crawler->selectButton('Modifier');
        $form = $submitButton->form();

        $form["user[email]"] = "mk@todo.com";
        $form["user[password]"] = "mariekondo";
        $form["user[username]"] = "Marie Kondo";
        $form ["user[roles]"] = "ROLE_USER";

        //soumission du formulaire
        $client->submit($form);

        //verification du statut HTTP
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();








    }






}

