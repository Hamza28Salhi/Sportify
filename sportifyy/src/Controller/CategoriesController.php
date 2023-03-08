<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry; 
use App\Repository\CategoriesRepository;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;



class CategoriesController extends AbstractController
{

    #[Route('/bro', name: 'bro')]
    public function bro(): Response
    {
        return $this->render('categories/affichefront.html.twig');
    }


    #[Route('/categories', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    
    
    #[Route('/categories/add', name: 'categorie_add')]
    public function addCategorie(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $categories = new Categories();
        $form = $this->createForm(CategoriesType::class,$categories);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($categories);
            $em->flush();
            return $this->redirectToRoute('categorie_list');
        }

        return $this->renderForm('categories/add.html.twig',['categoriesForm'=>$form]);
    }
    #[Route('/categories/list', name: 'categorie_list')]
    public function list(CategoriesRepository $categoriesRepository,PaginatorInterface $paginator,Request $request): Response {
        $data = $categoriesRepository->findAll();
        $categories = $paginator->paginate(
            $data, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
           3 /*limit per page*/
        );
    
        return $this->render('categories/list.html.twig', ['categorie' => $categories]);
    }
    #[Route('/categories/{id}/delete', name: 'categorie_delete')]
public function delete(ManagerRegistry $doctrine, int $id, FlayNotifier $flashy): Response
{
    $em = $doctrine->getManager();
    $abonne = $em->getRepository(Categories::class)->find($id);

    if (!$abonne) {
        throw $this->createNotFoundException('The membership was not found');
    }
    $flashy->error('Abonnement supprimé!', 'http://your-awesome-link.com');

    $em->remove($abonne);
    $em->flush();


    return $this->redirectToRoute('categorie_list');
}

#[Route('/categories/update/{id}', name: 'categorie_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $abonne = $em->getRepository(categories::class)->find($id);

    if (!$abonne) {
        throw new NotFoundHttpException('membership not found');
    }

    $form = $this->createForm(CategoriesType::class, $abonne);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();

        return $this->redirectToRoute('categorie_list');
    }

    return $this->render('categories/update.html.twig', [
        'abonne' => $abonne,
        'categoriesForm' => $form->createView(),
    ]);
}
}
