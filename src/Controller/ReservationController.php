<?php

namespace App\Controller;
use App\Entity\Reservation;
use App\Form\FormReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ReservationRepository;


class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }

    #[Route('/reservation/add', name: 'reservation_add')]
    public function addReservation(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $reservation = new Reservation();
        $form = $this->createForm(FormReservationType::class,$reservation);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('reservation_add');
        }

        return $this->renderForm('reservation/addR.html.twig',['form'=>$form]);
    }


    #[Route('/reservation/list', name: 'reservation_list')]
    public function list(ManagerRegistry $doctrine): Response {
        $em = $doctrine->getManager();
        $Reservation = $em->getRepository(Reservation::class)->findAll();
    
        return $this->render('reservation/listR.html.twig', ['reservation' => $Reservation]);
    }

    #[Route('/reservation/{id}/delete', name: 'reservation_delete')]
public function delete(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $Reservation = $em->getRepository(Reservation::class)->find($id);

    if (!$Reservation) {
        throw $this->createNotFoundException('The reservation was not found');
    }

    $em->remove($Reservation);
    $em->flush();

    return $this->redirectToRoute('reservation_list');
}

#[Route('/reservation/update/{id}', name: 'reservation_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $Reservation = $em->getRepository(Reservation::class)->find($id);

   

    $form = $this->createForm(FormReservationType::class, $Reservation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();

        return $this->redirectToRoute('reservation_list');
    }

    return $this->render('reservation/updateR.html.twig', [
        'reservation' => $Reservation,
        'form' => $form->createView(),
    ]);
}




}
