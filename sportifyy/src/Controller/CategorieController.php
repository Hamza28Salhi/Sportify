<?php

namespace App\Controller;
use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;






class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }
    
    #[Route('/categorie/addC', name: 'categorie_add')]
    public function addCategorie(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $Categorie = new Categorie();
        $form = $this->createForm(CategorieType::class,$Categorie);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($Categorie);
            $em->flush();
            return $this->redirectToRoute('categorie_afficheC');
        }
        return $this->renderForm('categorie/addC.html.twig',['form'=>$form]);
}

#[Route('/categorie/afficheC', name: 'categorie_afficheC')]
public function afficheC(ManagerRegistry $doctrine): Response {
    $em = $doctrine->getManager();
    $categorie = $em->getRepository(Categorie::class)->findAll();

    return $this->render('categorie/afficheC.html.twig', ['categorie' => $categorie]);
}


#[Route('/categorie/{id}/delete', name: 'categorie_delete')]
public function categorie(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $categorie = $em->getRepository(Categorie::class)->find($id);

    if (!$categorie) {
        throw $this->createNotFoundException('The categorie was not found');
    }

    $em->remove($categorie);
    $em->flush();

    return $this->redirectToRoute('categorie_afficheC');
}


#[Route('/categorie/update/{id}', name: 'categorie_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $categorie = $em->getRepository(Categorie::class)->find($id);

    if (!$categorie) {
        throw new NotFoundHttpException('categorie not found');
    }

    $form = $this->createForm(CategorieType::class, $categorie);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();

        return $this->redirectToRoute('categorie_afficheC');
    }

    return $this->render('categorie/update.html.twig', [
        'categorie' => $categorie,
        'form' => $form->createView(),
    ]);

}
}