<?php

namespace App\Controller;
use App\Entity\Equipe;
use App\Form\EquipeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class EquipeController extends AbstractController
{
    #[Route('/equipe', name: 'app_equipe')]
    public function index(): Response
    {
        return $this->render('equipe/index.html.twig', [
            'controller_name' => 'EquipeController',
        ]);
    }


    #[Route('/equipe/add', name: 'equipe_add')]
    public function addEquipe(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $Equipe = new Equipe();
        $form = $this->createForm(EquipeType::class,$Equipe);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($Equipe);
            $em->flush();
            return $this->redirectToRoute('equipe_afficheC');
        }

        return $this->renderForm('equipe/add.html.twig',['form'=>$form]);
    }
    
    #[Route('/equipe/afficheC', name: 'equipe_afficheC')]
public function afficheC(ManagerRegistry $doctrine): Response {
    $em = $doctrine->getManager();
    $equipe = $em->getRepository(Equipe::class)->findAll();

    return $this->render('equipe/afficheC.html.twig', ['equipe' => $equipe]);
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

#[Route('/equipe/{id}/delete', name: 'equipe_delete')]
public function delete(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $match = $em->getRepository(Equipe::class)->find($id);

    if (!$match) {
        throw $this->createNotFoundException('The match was not found');
    }

    $em->remove($match);
    $em->flush();

    return $this->redirectToRoute('equipe_afficheC');
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

#[Route('/equipe/update/{id}', name: 'equipe_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $match = $em->getRepository(Equipe::class)->find($id);

    if (!$match) {
        throw new NotFoundHttpException('Match not found');
    }

    $form = $this->createForm(EquipeType::class, $match);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();

        return $this->redirectToRoute('equipe_afficheC');
    }

    return $this->render('equipe/update.html.twig', [
        'match' => $match,
        'form' => $form->createView(),
    ]);
}


















}


