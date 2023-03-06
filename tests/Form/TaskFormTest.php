<?php

namespace App\tests\Form;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskFormTest extends WebTestCase 
{

    public function loginUser()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        
        $form = $crawler->selectButton('Connectez-vous')->form([
            'email' => 'valerie.guillet@ribeiro.com',
            'password' => 'password'
        ]);

        $client->submit($form);

        return $client;
    }

    public function testCreateTaskForm(): void {

        // $client = static::createClient();
        $client = $this->loginUser();

        $crawler = $client->request('GET', '/task/create'); 

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('label', 'Title' );

        //Recuperation du formulaire
        $submitButton = $crawler->selectButton('Ajouter');
        $form = $submitButton->form();

        $form["task[title]"] = "Weekly checkup";
        $form ["task[content]"] = "Verification des travaux encours cette semaine";

        //soumission du formulaire
        $client->submit($form);

        //verification du statut HTTP
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();








    }






}

