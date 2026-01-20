<?php

namespace App\Controller;

use App\Repository\PizzaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


final class HomeController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(PizzaRepository $repository): Response
    {
        $pizzas = $repository->findAll();
        
        return $this->render('home/accueil.html.twig', [
            'pizzeria' => $pizzas,

        ]);
    }
}
