<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\AddPizzaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AddPizzaController extends AbstractController
{
    #[Route('/ajout_pizza', name: 'ajout_pizza')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pizza = new Pizza();
        $pizzaform = $this->createForm(AddPizzaType::class, $pizza);
        $pizzaform->handleRequest($request);
        if ($pizzaform->isSubmitted() && $pizzaform->isValid()){
            $entityManager->persist($pizza);
            $entityManager->flush();
            $this->addFlash('success','Votre pizza est ajoutée avec succès !');
            return $this->redirectToRoute('accueil');
        }

        return $this->render('ajout_pizza/add_pizza.html.twig', [
            'pizzaform' => $pizzaform->createView(),
        ]);
    }
}
