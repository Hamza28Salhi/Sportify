<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
<<<<<<< HEAD
=======
use App\Form\SecondFormType;
>>>>>>> origin/GestionUser
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
<<<<<<< HEAD

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
=======
use Symfony\Component\HttpFoundation\File\UploadedFile ;
use App\Service\FileUploader;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;



class RegistrationController extends AbstractController
{
   


    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
>>>>>>> origin/GestionUser
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
<<<<<<< HEAD
            // encode the plain password
=======

            
            $showSecondForm = $form->get('show_second_form')->getData();
            // encode the plain password
            $file = $form['user_pic']->getData();
            if ($file) {
                $fileName = $fileUploader->upload($file);
                $user->setUserPic($fileName);
            }
>>>>>>> origin/GestionUser
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

<<<<<<< HEAD
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('home');
        }
=======
            // set the confirmation status to false
           

            if  ($showSecondForm) {
                $entityManager->persist($user);
            $entityManager->flush();

                return $this->redirectToRoute('app_register2', ['id' => (int) $user->getId()]);
            }
            else{
            // do anything else you need here, like send an email
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_login');
        }
    }

>>>>>>> origin/GestionUser

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

<<<<<<< HEAD

    #[Route('/list', name: 'user_list')]
public function list(ManagerRegistry $doctrine): Response {
    $em = $doctrine->getManager();
    $user = $em->getRepository(User::class)->findAll();

    return $this->render('registration/listUsers.html.twig', ['user' => $user]);
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

#[Route('update/{id}', name: 'user_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $user = $em->getRepository(User::class)->find($id);

    if (!$user) {
        throw new NotFoundHttpException('user not found');
    }

    $form = $this->createForm(RegistrationFormType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();

        return $this->redirectToRoute('user_list');
    }

    return $this->render('registration/update.html.twig', [
        'user' => $user,
        'form' => $form->createView(),
    ]);
}

=======
    #[Route('/register2/{id}', name: 'app_register2')]
    public function register2(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $secondForm = $this->createForm(secondFormType::class, $user);
        $secondForm->handleRequest($request);

        if ($secondForm->isSubmitted() && $secondForm->isValid()) {

           
            
            // encode the plain password


            

            
            
            

            
           

            
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
            } 
        



        return $this->render('registration/register2.html.twig', [
            'secondForm' => $secondForm->createView(),
        ]);
    }


    
>>>>>>> origin/GestionUser


}
