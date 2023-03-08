<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservationRepository;
use App\Repository\EvenementRepository;

class StatController extends AbstractController
{
    #[Route('evenement/stat', name: 'app_stat')]
   public function stat(ReservationRepository $reservationRepository,EvenementRepository $evenementRepository): Response
    {
        $reservations = $reservationRepository->findAll();
        $evenements = $evenementRepository->findAll();
        $reservationNom = [];
        $evenementId = [];
    
        foreach($reservations as $reservation)
        {
           $reservationNom[] = $reservation->getNom();
        }

        foreach($evenements as $evenement)
        {
            $evenementId[] = $evenement->getId();

         }
       return $this->render('reservation/stats.html.twig', [
            'reservationNom' => json_encode($reservationNom),
            'evenementId' => json_encode($evenementId),
    
        ]);

        return $this->render('stat/index.html.twig', [
            'controller_name' => 'EvenementController',
        ]);
      
    }
}
