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

        // $client = static::createClient();
        
        // $userRepository = static::getContainer()->get(UserRepository::class);
        // $user = $userRepository->findOneByEmail('valerie.guillet@gmail.com');

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

        // $this->assertSelectorTextContains('label', "Mot de passe");
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $this->assertResponseRedirects('/users/list');
        
    }


    public function testUserEdit(): void {

        // $client = static::createClient();

        $client = $this->loginAdmin();
        $crawler = $client->request('GET', '/users/58/edit');

        $form = $crawler->selectButton('Modifier')->form([
			'user[email]'=>"Balla@todo.com",
            'user[password][first]'=> "ballamoussa",
            'user[password][second]'=> "ballamoussa",
            'user[username]'=> "Balla Moussa",
            // 'user[roles][0]'->tick()
		]);
        $form["user[roles][0]"]->tick();

        
        $client->submit($form);

        $this->assertSelectorTextContains('button', "Modifier");
		$this->assertResponseRedirects('/users/list');
		$client->followRedirect();
		
    }


    
}