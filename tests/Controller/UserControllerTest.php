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
        
        $form = $crawler->selectButton('Connectez-vous')->form([
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
            'user[password]'=> "sarah",
            'user[username]'=> "Sarah Messan",
            'user[roles]'=> "ROLE_USER"

        ]);

        $client->submit($form);

        $this->assertSelectorTextContains('label', "Mot de passe");
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $this->assertResponseRedirects('/users/list');
        
    }


    public function testUserEdit(): void {

        // $client = static::createClient();

        $client = $this->loginAdmin();
        $crawler = $client->request('GET', '/users/57/edit');

        $form = $crawler->selectButton('Modifier')->form([
			'user[email]'=>"Balla@todo.com",
            'user[password]'=> "ballamoussa",
            'user[username]'=> "Balla Moussa",
            'user[roles]'=> "ROLE_USER"
		]);
        
        $client->submit($form);

        $this->assertSelectorTextContains('button', "Modifier");
		$this->assertResponseRedirects('/users/list');
		$client->followRedirect();
		
    }


    public function testDeleteUser() {

        // $client = static::createClient();

        $client = $this->loginAdmin();
        $client->request('GET', '/users/56/edit');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertResponseRedirects('/users/list');

    }

}