<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commentaire;
//use App\Controller\PostController;
use App\Form\CommentaireType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CommentaireController extends AbstractController
{
    #[Route('/commentaire', name: 'app_commentaire')]
    public function index(): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }

    #[Route('/commentaire/commentaire_add', name: 'commentaire_add')]
    public function addCommentaire(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class,$commentaire);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $commentaire->setDateCreationCommentaire(new \DateTime());
            $em->persist($commentaire);
            $em->flush();
            return $this->redirectToRoute('commentaire_show');
        }

        return $this->renderForm('commentaire/commentaire_add.html.twig',['form'=>$form]);
    }

    #[Route('/commentaire/commentaire_show', name: 'commentaire_show')]
public function list(ManagerRegistry $doctrine): Response {
    $em = $doctrine->getManager();
    $commentaire = $em->getRepository(Commentaire::class)->findAll();

    return $this->render('commentaire/commentaire_show.html.twig', ['commentaire' => $commentaire]);
}

//Section commentaires: supprimer commentaire
#[Route('/commentaire/{id}/commentaire_delete', name: 'commentaire_delete')]
public function delete(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $commentaire = $em->getRepository(Commentaire::class)->find($id);

    if (!$commentaire) {
        throw $this->createNotFoundException('The commentaire was not found');
    }

    $em->remove($commentaire);
    $em->flush();

    return $this->redirectToRoute('commentaire_show');
}

#[Route('/commentaire/commentaire_update/{id}', name: 'commentaire_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $commentaire = $em->getRepository(Commentaire::class)->find($id); //on a changé utilisateur par Commentaire

    if (!$commentaire) {
        throw new NotFoundHttpException('commentaire not found');
    }

    $form = $this->createForm(CommentaireType::class, $commentaire);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $commentaire->setDateCreationCommentaire(new \DateTime());
        $em->flush();

        return $this->redirectToRoute('commentaire_show');
    }

    return $this->render('commentaire/commentaire_update.html.twig', [
        'commentaire' => $commentaire,
        'form' => $form->createView(),
    ]);
}




}
