<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testTaskList(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/task/list');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('.btn-info');
        
    }

    public function testCreateTask():void
    {
        $client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneByEmail('valerie.guillet@ribeiro.com');
        
        $client->loginUser($user);

        $crawler = $client->request('GET', '/task/create');

        $form = $crawler->selectButton('Ajouter')->form([    
            'task[title]'=>"Organisation des equipes",
            'task[content]'=> "Toutes les equipes seront constituées demain matin."
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

    }


    public function testEditTask(): void {

        $client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneByEmail('valerie.guillet@ribeiro.com');
    
        $client->loginUser($user);
        $taskRepository = static::getContainer()->get(TaskRepository::class);
        $task = $taskRepository->findOneBy([
            'user' =>$user
        ]);

        $crawler = $client->request('GET', '/task/2/edit');
        
        $form = $crawler->selectButton('Modifier')->form([    
            'task[title]'=> "Etablir le budget",
            'task[content]'=> "C'est à vous de savoir ce que le budget 
                                mis en œuvre peut vous rapporter par la suite. 
                                Le retour sur investissement, très important, est donc à prendre en compte. "
        ]);
            
        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        // $this->assertSelectorTextContains('div.alert-success', 'La tâche a été bien été modifiée.');

    }

    public function testDeleteTask() {

        $client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('valerie.guillet@gmail.com');
    
        $taskRepository = static::getContainer()->get(TaskRepository::class);
        $task = $taskRepository->findOneBy([
            'user' =>$testUser
        ]);

        $crawler = $client->request('GET', '/task/2/edit');
        
        $this->assertResponseRedirects();
        $client->followRedirect();
        


        
        
        

    }


}
