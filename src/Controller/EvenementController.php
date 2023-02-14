<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\FormEvenementType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\EvenementRepository;
use App\Entity\Reservation;
use App\Form\FormReservationType;


class EvenementController extends AbstractController
{
    #[Route('/evenement', name: 'app_evenement')]
    public function index(): Response
    {
        return $this->render('evenement/index.html.twig', [
            'controller_name' => 'EvenementController',
        ]);
    }

    #[Route('/evenement/add', name: 'evenement_add')]
    public function addEvenement(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $Evenement = new Evenement();
        $form = $this->createForm(FormEvenementType::class,$Evenement);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($Evenement);
            $em->flush();
            return $this->redirectToRoute('evenement_add');
        }

        return $this->renderForm('evenement/add.html.twig',['form'=>$form]);
    }


    #[Route('/evenement/list', name: 'evenement_list')]
    public function list(ManagerRegistry $doctrine): Response {
        $em = $doctrine->getManager();
        $evenement = $em->getRepository(Evenement::class)->findAll();
    
        return $this->render('evenement/list.html.twig', ['evenement' => $evenement]);
    }

    #[Route('/evenement/{id}/delete', name: 'evenement_delete')]
public function delete(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $evenement = $em->getRepository(Evenement::class)->find($id);

    if (!$evenement) {
        throw $this->createNotFoundException('The evenment was not found');
    }

    $em->remove($evenement);
    $em->flush();

    return $this->redirectToRoute('evenement_list');
}

#[Route('/evenement/update/{id}', name: 'evenement_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $evenement = $em->getRepository(Evenement::class)->find($id);

   

    $form = $this->createForm(FormEvenementType::class, $evenement);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();

        return $this->redirectToRoute('evenement_list');
    }

    return $this->render('evenement/update.html.twig', [
        'evenement' => $evenement,
        'form' => $form->createView(),
    ]);
}


}
