<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
// use App\Service\UserService;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{ 
    
    #[Route('/users/list', name:"userList")]

    public function userList(UserRepository $userRepository): Response
    {
        return $this->render('user/list.html.twig', ['users' => $userRepository->findAll()]);
    }

    
    #[Route('/users/create', name:"user_create")]
     
    public function create_user(Request $request, UserRepository $userRepository,
                                UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = new User();
        
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $userRepository->setUser($userPasswordHasher->hashPassword($user, $user->getPassword()), 
                                        $user->getRoles(), $user->getEmail(), $user->getUsername());

            $this->addFlash('success', "L'utilisateur a bien été créé.");

            return $this->redirectToRoute('userList');
        }

        return $this->render('user/create.html.twig', ['form' => $form->createView()]);
    }

    
    #[Route('/users/{id}/edit', name:"editUser")]
    
    public function editUser( int $id, Request $request, EntityManagerInterface $em, 
                            UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', "Vous ne pouvez pas modifier l'utilisateur" );

        $user = $em->getRepository(User::class)->find($id);
        
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {                       
             $user->setPassword(
                    $userPasswordHasher->hashPassword($user, $user->getPassword()));
              
            $em->persist($user);
            $em->flush();
                
            $this->addFlash('success', "L'utilisateur a bien été modifié.");

            return $this->redirectToRoute('userList');
        }
        return $this->render('user/edit.html.twig', ['form' => $form, 'user' => $user]);
        
    }
}
