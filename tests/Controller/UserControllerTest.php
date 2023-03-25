<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase 
{
    public function testUserList() {

        $client = static::createClient();
        $crawler = $client->request('GET', '/users/list');

        $this->assertResponseIsSuccessful();
    }

    public function testUserListPageContent() {

        $client = static::createClient();
        $crawler = $client->request('GET', '/users/list');

        $this->assertSame(1, $crawler->filter('h2')->count());

        
        $this->assertSelectorTextContains('a.btn.btn-success.btn-sm', 'Modifier');
        
    }

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


    public function testCreateUser(): void {

       

         $client = $this->loginAdmin();

        $crawler = $client->request('GET', '/users/create');

        $form = $crawler->selectButton('Ajouter')->form([    
            'user[email]'=>"sarah@todo.com",
            'user[password][first]'=> "sarah",
            'user[password][second]'=> "sarah",
            'user[username]'=> "Sarah Messan",
            // 'user[roles][0]'->tick()

        ]);
        $form["user[roles][0]"]->tick();


        $client->submit($form);

        // $this->assertSelectorTextContains('button', "Ajouter");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        // $this->assertResponseRedirects('/users/list');
        
    }


    


    
}