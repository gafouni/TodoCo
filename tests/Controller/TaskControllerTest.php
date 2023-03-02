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
        // $urlGenerator = $client->getContainer()->get('router');
        // $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');
        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneByEmail('valerie.guillet@gmail.com');
        // $user = $entityManager->find(User::class, 1);

        $client->loginUser($user);

        // $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('task_create'));
        $crawler = $client->request('GET', '/task/create');

        //$form = $crawler->filter('form[name=task]')->form([
        $form = $crawler->selectButton('Ajouter')->form([    
            'task[title]'=>"Organisation des equipes",
            'task[content]'=> floatVal(33)
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

    }


    public function testEditTask(): void {

        $client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneByEmail('valerie.guillet@gmail.com');
    
        $client->loginUser($user);
        $taskRepository = static::getContainer()->get(TaskRepository::class);
        $task = $taskRepository->findOneBy([
            'user' =>$user
        ]);

        $crawler = $client->request('GET', '/task/2/edit');
        // $this->assertSelectorTextContains('button', 'Modifier');

        
        $form = $crawler->selectButton('Modifier')->form([    
            'task[title]'=>"Organisation des jeux",
            'task[content]'=> floatVal(30)
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'La tâche a été bien été modifiée.');

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
        // $this->assertSelectorExists('success');


        
        
        

    }


}
