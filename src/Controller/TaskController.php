<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use DataTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    public function createTask(Request $request, EntityManagerInterface $em)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmited() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $task->getCreatedAt(new DataTimeImmutable('now'))
                ->setUser($this->getUser());

            $em->persist($task);
            $em->flush();

            $this->addFlash('success', 'La tâche a été bien été ajoutée.');

            return $this->redirectToRoute('taskList');
        }

        return $this->render('task/create.html.twig', ['form' => $form->createView()]);
    }

    
    #[Route('/task/{id}/edit', name:"taskEdit")]
    
    public function editAction( Request $request, EntityManagerInterface $em)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmited() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $task->getCreatedAt(new DataTimeImmutable('now'))
                ->setUser($this->getUser());

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

    public function toggleTask(EntityManagerInterface $em)
    {
        $task = new Task();
        $task->toggle(!$task->isDone());
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success', sprintf('La tâche %s a bien été marquée comme faite.', $task->getTitle()));

        return $this->redirectToRoute('taskList');
    }

    
    #[Route('/task/{id}/delete', name:"taskDelete")]

    public function deleteTask()
    {
        $task = new Task();
        $task = $taskRepository->find(id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        $this->addFlash('success', 'La tâche a bien été supprimée.');

        return $this->redirectToRoute('taskList');
    }
}
