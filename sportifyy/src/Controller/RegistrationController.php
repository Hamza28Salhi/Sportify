<?php

namespace App\Controller;

use App\Repository\UserRepository;
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
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;




class RegistrationController extends AbstractController
{
   


    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, FileUploader $fileUploader, TokenGeneratorInterface $tokenGenerator, MailerInterface $mailer): Response
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

            // Generate a unique activation token
            $activationToken = $tokenGenerator->generateToken();
            $user->setActivationToken($activationToken);


            $entityManager->persist($user);
            $entityManager->flush();

            $email = (new TemplatedEmail())
                ->from('sportify0123@gmail.com')
                ->to($user->getEmail())
                ->subject('Activate your account')
                ->htmlTemplate('registration/activate_account_email.html.twig')
                ->context([
                    'user' => $user,
                ]);
            $mailer->send($email);
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

           
            

            $entityManager->flush();

             

            // do anything else you need here, like send a confirmation email

            

            return $this->redirectToRoute('app_login');
            } 
        



        return $this->render('registration/register2.html.twig', [
            'secondForm' => $secondForm->createView(),
        ]);
    }


    /**
     * @Route("/activate-account/{id}/{token}", name="app_activate_account")
     */
    public function activateAccount(UserRepository $userRepository, string $id, string $token): Response
    {
        $user = $userRepository->find($id);

        if (!$user || $user->getActivationToken() !== $token) {
            throw $this->createNotFoundException('The activation link is invalid');
        }

        $user->setIsActive(true);
        $user->setActivationToken(null);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('app_login');
    }


}
