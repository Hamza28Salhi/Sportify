<?php

namespace App\Controller;
use App\Entity\Matches;
use App\Form\MatchesType;
use App\Form\MatchesnsType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class MatchesController extends AbstractController
{
    #[Route('/matches', name: 'app_matches')]
    public function index(): Response
    {
        return $this->render('matches/index.html.twig', [
            'controller_name' => 'MatchesController',
        ]);
    }
    #[Route('/matches/add', name: 'matches_add')]
    public function addMatches(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $Matches = new Matches();
        $form = $this->createForm(MatchesType::class,$Matches);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($Matches);
            $em->flush();
            return $this->redirectToRoute('matches_afficheC');
        }

        return $this->renderForm('matches/add.html.twig',['form'=>$form]);
    }


    #[Route('/matches/addns', name: 'matches_addns')]
    public function addMatches1(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $Matches = new Matches();
       $form = $this->createForm(MatchesnsType::class, $Matches);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($Matches);
            $em->flush();
            return $this->redirectToRoute('matches_afficheC');
        }

        return $this->renderForm('matches/addns.html.twig',['form'=>$form]);
    }


    
    #[Route('/matches/afficheC', name: 'matches_afficheC')]
public function afficheC(ManagerRegistry $doctrine): Response {
    $em = $doctrine->getManager();
    $matches = $em->getRepository(Matches::class)->findAll();

    return $this->render('matches/afficheC.html.twig', ['matches' => $matches]);
}

#[Route('/matches/afficheCC', name: 'matches_afficheCC')]
public function afficheCC(ManagerRegistry $doctrine): Response {
    $em = $doctrine->getManager();
    $matches = $em->getRepository(Matches::class)->findAll();

    return $this->render('matches/afficheCC.html.twig', ['matches' => $matches]);
}


#[Route('/matches/afficheCadd', name: 'matches_afficheCadd')]
public function afficheCadd(ManagerRegistry $doctrine): Response {
    $em = $doctrine->getManager();
    $matches = $em->getRepository(Matches::class)->findAll();

    return $this->render('matches/afficheCadd.html.twig', ['matches' => $matches]);
}




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

#[Route('/matches/{id}/delete', name: 'matches_delete')]
public function delete(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $match = $em->getRepository(Matches::class)->find($id);

    if (!$match) {
        throw $this->createNotFoundException('The match was not found');
    }

    $em->remove($match);
    $em->flush();

    return $this->redirectToRoute('matches_afficheC');
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

#[Route('/matches/update/{id}', name: 'matches_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $match = $em->getRepository(Matches::class)->find($id);

    if (!$match) {
        throw new NotFoundHttpException('Match not found');
    }

    $form = $this->createForm(MatchesType::class, $match);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();

        return $this->redirectToRoute('matches_afficheC');
    }

    return $this->render('matches/update.html.twig', [
        'match' => $match,
        'form' => $form->createView(),
    ]);
}

 

}
