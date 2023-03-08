<?php

namespace App\Controller;
use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Service\FileUploader;
use Doctrine\Persistence\ManagerRegistry; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use DateTime;

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
    public function addEquipe(ManagerRegistry $doctrine, Request $req, FileUploader $fileUploader): Response
    {
        $em = $doctrine->getManager();
        $Equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $Equipe);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
    
            $file = $form['picture']->getData();
            if ($file) {
                $fileName = $fileUploader->upload($file);
                $Equipe->setPicture($fileName);
            }
            $em->persist($Equipe);
            $em->flush();
            return $this->redirectToRoute('equipe_afficheC');
        }
    
        return $this->renderForm('equipe/add.html.twig',['form'=>$form]);
        
    }
    
    
    #[Route('/equipe/afficheC/{sortBy}/{sortOrder<[^/]+>}', name: 'equipe_afficheC')]
    public function afficheC(ManagerRegistry $doctrine, $sortBy = 'id', $sortOrder = 'asc'): Response {
        $em = $doctrine->getManager();
        $sortOrder = str_replace('/', '', $sortOrder);
        $equipes = $em->getRepository(Equipe::class)->findAllOrderedByProperty($sortBy, $sortOrder);
        return $this->render('equipe/afficheC.html.twig', ['equipe' => $equipes]);
    }
 

    #[Route('/equipe/afficheCC/{sortBy}/{sortOrder<[^/]+>}', name: 'equipe_afficheCC')]
    public function afficheCC(Request $request, ManagerRegistry $doctrine, $sortBy = 'id', $sortOrder = 'asc'): Response
    {
        $em = $doctrine->getManager();
        $sortOrder = str_replace('/', '', $sortOrder);
        
        // Pagination
        $perPage = 8; // Nombre d'équipes par page
        $currentPage = $request->query->getInt('page', 1); // Numéro de la page courante, 1 si non défini
        $offset = ($currentPage - 1) * $perPage; // Offset pour la requête
        
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->select('e')
            ->from(Equipe::class, 'e')
            ->orderBy('e.'.$sortBy, $sortOrder)
            ->setFirstResult($offset)
            ->setMaxResults($perPage);
        
        $query = $queryBuilder->getQuery();
        $equipe = $query->getResult();
        
        $totalEquipe = $em->getRepository(Equipe::class)->count([]); // Nombre total d'équipes
        $totalPages = ceil($totalEquipe / $perPage); // Nombre total de pages
    
        // Fetch the matches associated with each equipe
        $matchesByEquipe = [];
        foreach ($equipe as $eq) {
            $matches = $eq->getMatches()->toArray();
            $matchesByEquipe[$eq->getId()] = $matches;
        }
    
        // Create a DateTime object for the current date and time
        $now = new DateTime();
    
        return $this->render('equipe/afficheCC.html.twig', [
            'equipe' => $equipe,
            'matchesByEquipe' => $matchesByEquipe,
            'now' => $now,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage
        ]);
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

public function update(ManagerRegistry $doctrine, Request $request, $id, FileUploader $fileUploader): Response
{
    $em = $doctrine->getManager();
    $equipe = $em->getRepository(Equipe::class)->find($id);

    if (!$equipe) {
        throw $this->createNotFoundException('Equipe not found');
    }

    $form = $this->createForm(EquipeType::class, $equipe);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $file = $form['picture']->getData();
        if ($file) {
            $newFileName = $fileUploader->upload($file);
            $equipe->setPicture($newFileName);
        }
        
        $em->flush();

        return $this->redirectToRoute('equipe_afficheC');
    }

    return $this->render('equipe/update.html.twig', [
        'equipe' => $equipe,
        'form' => $form->createView(),
    ]);
}

















}


