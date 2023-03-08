<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\UserBanService;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EditUserType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;



class AdminController extends AbstractController
{
    #[Route(path: 'admin/bro', name: 'bro')]
    public function bro(): Response
    {
        return $this->render('user/updateProfile.html.twig');
    }

   



    #[Route('/admin', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
        
    }

    #[Route('admin/list', name: 'user_list')]
    public function userlist(Request $request,UserRepository $user, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $userRepository = $em->getRepository(User::class);
        // Get the search query and the selected field from the form
        $searchQuery = $request->query->get('search');
        $searchField = $request->query->get('search_field');

        // Build the query based on the selected field and search query
        $queryBuilder = $userRepository->createQueryBuilder('u');
        if ($searchQuery && $searchField) {
            if ($searchField == 'full_name') {
                $queryBuilder->where('u.full_name LIKE :searchQuery')
                    ->setParameter('searchQuery', '%'.$searchQuery.'%');
            } elseif ($searchField == 'email') {
                $queryBuilder->where('u.email LIKE :searchQuery')
                    ->setParameter('searchQuery', '%'.$searchQuery.'%');
            }
        }
    
        // Get the matches based on the query
        $user = $queryBuilder->getQuery()->getResult();
    
        return $this->render('admin/list.html.twig', [
            'user' => $user,
            'searchQuery' => $searchQuery,
            'searchField' => $searchField,
        ]);
    }


    #[Route('{id}/delete', name: 'user_delete')]
public function delete(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $utilisateur = $em->getRepository(User::class)->find($id);

    if (!$utilisateur) {
        throw $this->createNotFoundException('The user was not found');
    }

    $em->remove($utilisateur);
    $em->flush();

    return $this->redirectToRoute('user_list');
}


    #[Route('admin/update/{id}', name: 'user_update')]
    public function update(ManagerRegistry $doctrine, Request $request, $id, FileUploader $fileUploader): Response
{
    $em = $doctrine->getManager();
    $user = $em->getRepository(User::class)->find($id);

    if (!$user) {
        throw new NotFoundHttpException('user not found');
    }

    $form = $this->createForm(EditUserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $file = $form['user_pic']->getData();
            if ($file) {
                $fileName = $fileUploader->upload($file);
                $user->setUserPic($fileName);
            }
        $em->flush();

        return $this->redirectToRoute('user_list');
    }

    return $this->render('admin/update.html.twig', [
        'user' => $user,
        'userForm' => $form->createView(),
    ]);
}


#[Route('admin/search', name: 'user_search')]
public function search(Request $request)
    {
        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($request);
        $searchQuery = $request->query->get('search');

        $results = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $query = $form->getData()['query'];
            // TODO: Perform the search and store the results in $results.
        }

        return $this->render('list.html.twig', [
            'search_form' => $form->createView(),
            'results' => $results,
            'searchQuery' => $searchQuery
        ]);
    }


    #[Route('admin/{sortBy}/{sortOrder<[^/]+>}', name: 'user_sort')]
    public function afficheC(ManagerRegistry $doctrine, $sortBy = 'id', $sortOrder = 'asc'): Response {
        $em = $doctrine->getManager();
        $sortOrder = str_replace('/', '', $sortOrder);
        $user = $em->getRepository(User::class)->findAllOrderedByProperty($sortBy, $sortOrder);
        return $this->render('admin/list.html.twig', ['user' => $user]);
    }


    #[Route('/admin/registrations', name: 'admin_registrations')]
    public function RegistrationAdminController ()
    {
        // Query the database for all pending user registrations
        $user = $this->getDoctrine()->getRepository(User::class)->findBy(['confirmed' => false]);

        return $this->render('admin/registrations.html.twig', [
            'user' => $user,
        ]);
}





#[Route('/statistics', name: 'user_statistics')]
public function statistics(ManagerRegistry $doctrine): Response {
    $em = $doctrine->getManager();
    $userRepository = $em->getRepository(User::class);

    // Get the total number of users
    $totalUsers = $userRepository->createQueryBuilder('u')
        ->select('COUNT(u.id)')
        ->getQuery()
        ->getSingleScalarResult();

    // Get the number of users per role
    $userRoles = $userRepository->createQueryBuilder('u')
        ->select('u.roles AS roleName', 'COUNT(u.id) AS userCount')
        ->groupBy('u.roles')
        ->getQuery()
        ->getResult();

    // ...rest of the code

    return $this->render('admin/statistique.html.twig', [
        'totalUsers' => $totalUsers,
        'userRoles' => $userRoles,
    ]);
}



}