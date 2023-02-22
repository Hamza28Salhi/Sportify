<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\EditProfileType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\UploadedFile ;
use App\Service\FileUploader;



class UserController extends AbstractController
{
    #[Route(path: 'admin/hello', name: 'hello')]
    public function bro(): Response
    {
        return $this->render('user/userProfile.html.twig');
    }

    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('update/{id}', name: 'profile_update')]
    public function profile(ManagerRegistry $doctrine, Request $request, $id, FileUploader $fileUploader): Response
{
    $em = $doctrine->getManager();
    $user = $em->getRepository(User::class)->find($id);

    if (!$user) {
        throw new NotFoundHttpException('user not found');
    }

    $form = $this->createForm(EditProfileType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $file = $form['user_pic']->getData();
        if ($file) {
            $newFileName = $fileUploader->upload($file);
            $user->setUserPic($newFileName);
        }
        $em->flush();

        return $this->redirectToRoute('hello');
    }

    return $this->render('user/updateProfile.html.twig', [
        'user' => $user,
        'editprofileForm' => $form->createView(),
    ]);
}
}