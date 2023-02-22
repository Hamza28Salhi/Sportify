<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;   

class CategorieController extends AbstractController
{

    #[Route('/bro', name: 'bro')]
    public function bro(): Response
    {
        return $this->render('categorie/affichefront.html.twig');
    }


    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    
    
    #[Route('/categorie/add', name: 'categorie_add')]
    public function addCategorie(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class,$categorie);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('categorie_list');
        }

        return $this->renderForm('categorie/add.html.twig',['categorieForm'=>$form]);
    }
    #[Route('/categorie/list', name: 'categorie_list')]
    public function list(ManagerRegistry $doctrine): Response {
        $em = $doctrine->getManager();
        $categorie = $em->getRepository(Categorie::class)->findAll();
    
        return $this->render('categorie/list.html.twig', ['categorie' => $categorie]);
    }
    #[Route('/categorie/{id}/delete', name: 'categorie_delete')]
public function delete(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $abonne = $em->getRepository(Categorie::class)->find($id);

    if (!$abonne) {
        throw $this->createNotFoundException('The membership was not found');
    }

    $em->remove($abonne);
    $em->flush();

    return $this->redirectToRoute('categorie_list');
}

#[Route('/categorie/update/{id}', name: 'categorie_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $abonne = $em->getRepository(categorie::class)->find($id);

    if (!$abonne) {
        throw new NotFoundHttpException('membership not found');
    }

    $form = $this->createForm(CategorieType::class, $abonne);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();

        return $this->redirectToRoute('categorie_list');
    }

    return $this->render('categorie/update.html.twig', [
        'abonne' => $abonne,
        'categorieForm' => $form->createView(),
    ]);
}
}
