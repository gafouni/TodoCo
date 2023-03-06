<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use DateTimeImmutable;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{
    
    #[Route('/task/list', name:"taskList")]

    public function taskList(TaskRepository $taskRepository)
    {
        return $this->render('task/list.html.twig', ['tasks' => $taskRepository->findAll()]);
    }

    #[Route('/task/create', name:"task_create")]

    public function createTask(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $em = $this->getDoctrine()->getManager();
            $task->getCreatedAt(new DateTimeImmutable('now'));
            $task->setUser($this->getUser());

            $em->persist($task);
            $em->flush();

            $this->addFlash('success', 'La tâche a été bien été ajoutée.');

            return $this->redirectToRoute('taskList');
        }

        return $this->render('task/create.html.twig', ['form' => $form]);
    }

    
    #[Route('/task/{id}/edit', name:"taskEdit")] 
    
    public function edit_task( int $id, Request $request, EntityManagerInterface $em): Response
    {

        $task = $em->getRepository(Task::class)->find($id);

        $this->denyAccessUnlessGranted('TASK_EDIT', $task, "Vous ne pouvez pas modifier cette tâche" );

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $em = $this->getDoctrine()->getManager();
            $task->setCreatedAt(new DateTimeImmutable('now'));
            $task->setUser($this->getUser());

            $em->persist($task);
            $em->flush();

            $this->addFlash('success', 'La tâche a été bien été modifiée.');

            return $this->redirectToRoute('taskList');
        }


        return $this->render('task/edit.html.twig', [
            'form' => $form->createView(),
            'task' => $task,
        ]);
    }

    
    #[Route('/task/{id}/toggle', name:"taskToggle")]

    public function toggleTaskAction(int $id, TaskRepository $taskRepository, EntityManagerInterface $em)
    {
        $task = $taskRepository->find($id);

        $this->denyAccessUnlessGranted('TASK_EDIT', $task, "Vous ne pouvez pas modifier cette tâche" );
        $task->toggle(!$task->isDone());
        $em->persist($task);
        $em->flush();

        if ($task->isDone() === false) {
            $this->addFlash('success', sprintf('La tâche %s a bien été marquée comme non termitée.', $task->getTitle()));
        } else {
            $this->addFlash('success', sprintf('La tâche %s a bien été marquée comme faite.', $task->getTitle()));
        }

        // $this->addFlash('success', sprintf('La tâche a bien été marquée comme faite.'));

        return $this->redirectToRoute('taskList');
    }

    
    #[Route('/task/{id}/delete', name:"taskDelete")]

    public function deleteTask(int $id, TaskRepository $taskRepository, EntityManagerInterface $em)
    {

        $task = new Task();
        $task = $taskRepository->find($id);

        $this->denyAccessUnlessGranted('TASK_DELETE', $task, "Vous ne pouvez pas supprimer cette tâche" );

        // $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        $this->addFlash('success', 'La tâche a bien été supprimée.');

        return $this->redirectToRoute('taskList');
    }
}
