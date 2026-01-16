<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\AddPizzaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class UpdatePizzaController extends AbstractController
{
    #[Route('/update/pizza/{id}', name: 'update_pizza')]
    public function modifiy(Pizza $pizza, Request $request, EntityManagerInterface $entityManager): Response
    {
        $pizzaform = $this->createForm(AddPizzaType::class, $pizza);
        $pizzaform->handleRequest($request);
        if ($pizzaform->isSubmitted() && $pizzaform->isValid()){
            $entityManager->persist($pizza);
            $entityManager->flush();
            $this->addFlash('success','Pizza modifiée avec succès !');
            return $this->redirectToRoute('accueil');
        }

        return $this->render('update_pizza/update_pizza.html.twig', [
            'pizzaform' => $pizzaform->createView(),
        ]);
    }
}
