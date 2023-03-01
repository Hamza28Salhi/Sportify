<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\SecondFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile ;
use App\Service\FileUploader;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;



class RegistrationController extends AbstractController
{
   


    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
            $showSecondForm = $form->get('show_second_form')->getData();
            // encode the plain password
            $file = $form['user_pic']->getData();
            if ($file) {
                $fileName = $fileUploader->upload($file);
                $user->setUserPic($fileName);
            }
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

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


        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

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


    


}
