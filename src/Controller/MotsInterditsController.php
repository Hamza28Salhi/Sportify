<?php

namespace App\Controller;

use App\Form\MotsInterditsType;
use App\Repository\MotsInterditsTypeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\MotsInterdits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CommentModerationService;


class MotsInterditsController extends AbstractController
{
    #[Route('/mots/interdits', name: 'app_mots_interdits')]
    public function index(): Response
    {
        return $this->render('mots_interdits/index.html.twig', [
            'controller_name' => 'MotsInterditsController',
        ]);
    }

    #[Route('/motsInterdits/motsInterdits_add', name: 'motsInterdits_add')]
    public function addMotsInterdits(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $motsInterdits = new MotsInterdits();
        $form = $this->createForm(MotsInterditsType::class,$motsInterdits);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($motsInterdits);
            $em->flush();
            $this->addFlash('success', 'Le mot interdit a été ajouté avec succès.');
            return $this->redirectToRoute('motsInterdits_show');
        }

        return $this->renderForm('mots_interdits/motsInterdits_add.html.twig',['form'=>$form]);
    }

    #[Route('/motsInterdits/motsInterdits_show', name: 'motsInterdits_show')]
    public function list(ManagerRegistry $doctrine): Response {
    $em = $doctrine->getManager();
    $motsInterdits = $em->getRepository(MotsInterdits::class)->findAll();

    return $this->render('mots_interdits/motsInterdits_show.html.twig', ['motsInterdits' => $motsInterdits]);
}

    
}
