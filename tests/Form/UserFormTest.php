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
        
        $form = $crawler->selectButton('Se connecter')->form([
            'email' => 'jr@list.com',
            'password' => '$2y$13$gOZV4ma74IN4N28FCOdMv.iwrjYH6sEfyLVs32Lf.wo6xrJn9JQne'
        ]);

        $client->submit($form);

        return $client;

    }    

    public function testCreateUserForm(): void {

        // $client = static::createClient();
        $client = $this->loginAdmin();

        $crawler = $client->request('GET', '/users/create');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('label', 'Nom d\'utilisateur' );
 
        //Recuperation du formulaire
        $submitButton = $crawler->selectButton('Ajouter');
        $form = $submitButton->form();

        $form["user[email]"] = "mk@todo.com";
        $form["user[password][first]"] = "mariekondo"; 
        $form["user[password][second]"] = "mariekondo";
        $form["user[username]"] = "Marie Kondo";
        $form["user[roles][0]"]->tick();

        // //soumission du formulaire
        $client->submit($form);

        // //verification du statut HTTP
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        // $client->followRedirect();









    }






}

