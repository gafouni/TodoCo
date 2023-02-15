<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    
    #[Route('/', name:"homepage")]
    public function index(): Response
    {
        return $this->render('homepage/index.html.twig');
    }
}
