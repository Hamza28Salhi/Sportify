<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


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



}
