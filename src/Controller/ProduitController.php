<?php

namespace App\Controller;
use App\Service\FileUploader;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    #[Route('/produit/addP', name: 'produit_add')]
    public function addProduit(ManagerRegistry $doctrine,Request $req, FileUploader $fileUploader): Response {
        $em = $doctrine->getManager();
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($req);

        
        if($form->isSubmitted() && $form->isValid())
            {
    
                $file = $form['image']->getData();
                if ($file) {
                    $fileName = $fileUploader->upload($file);
                    $produit->setImage($fileName);
                }
               
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('produit_afficheP');
        }
        return $this->renderForm('produit/addP.html.twig',['form'=>$form]);
}

#[Route('/produit/afficheP', name: 'produit_afficheP')]
public function afficheP(ManagerRegistry $doctrine): Response {
    $em = $doctrine->getManager();
    $produit = $em->getRepository(Produit::class)->findAll();

    return $this->render('produit/afficheP.html.twig', ['produit' => $produit]);
}

#[Route('/produit/affichePP', name: 'produit_affichePP')]
public function affichePP(ManagerRegistry $doctrine): Response {
    $em = $doctrine->getManager();
    $produit = $em->getRepository(Produit::class)->findAll();

    return $this->render('produit/affichePP.html.twig', ['produit' => $produit]);
}



#[Route('/produit/afficheCP/{id}', name: 'produit_afficheCP')]
public function afficheCP(ManagerRegistry $doctrine, $id): Response {
    $em = $doctrine->getManager();
    $produit = $em->getRepository(Produit::class)->find($id);
    
    if (!$produit) {
        throw $this->createNotFoundException('Produit not found');
    }

    return $this->render('produit/afficheCP.html.twig', ['produit' => $produit]);
}



#[Route('/produit/{id}/delete', name: 'produit_delete')]
public function produit(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $produit = $em->getRepository(Produit::class)->find($id);

    if (!$produit) {
        throw $this->createNotFoundException('The produit was not found');
    }

    $em->remove($produit);
    $em->flush();

    return $this->redirectToRoute('produit_afficheP');
}


#[Route('/produit/update/{id}', name: 'produit_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id, FileUploader $fileUploader): Response
{
    $em = $doctrine->getManager();
    $produit = $em->getRepository(Produit::class)->find($id);

    if (!$produit) {
        throw new NotFoundHttpException('produit not found');
    }

    $form = $this->createForm(ProduitType::class, $produit);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $file = $form['image']->getData();
        if ($file) {
            $newFileName = $fileUploader->upload($file);
            $produit->setImage($newFileName);
        }
        $em->flush();

        return $this->redirectToRoute('produit_afficheP');
    }

    return $this->render('produit/update.html.twig', [
        'produit' => $produit,
        'form' => $form->createView(),
    ]);

}




#[Route('/produit/recherche', name: 'produit_recherche')]
public function searchProduit(Request $request)
{
    $searchTerm = $request->request->get('searchTerm');

    $produits = $this->getDoctrine()
        ->getRepository(Produit::class)
        ->createQueryBuilder('p')
        ->where('p.nom_produit LIKE :searchTerm')
        ->orWhere('p.prix_produit LIKE :searchTerm')
        ->orWhere('p.marque_produit LIKE :searchTerm')
        ->orWhere('p.categorie LIKE :searchTerm')
        ->setParameter('searchTerm', '%' . $searchTerm . '%')
        ->getQuery()
        ->getResult();

    return $this->render('produit/index.html.twig', [
        'produits' => $produits,
    ]);
}
















}
