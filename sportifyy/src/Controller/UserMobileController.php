<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserMobileController extends AbstractController
{
    #[Route('/user/mobile', name: 'app_user_mobile')]
    public function index(): Response
    {
        return $this->render('user_mobile/index.html.twig', [
            'controller_name' => 'UserMobileController',
        ]);
    }

    #[Route("/AllUsers", name: "list")]
    //* Dans cette fonction, nous utilisons les services NormlizeInterface et StudentRepository, 
    //* avec la méthode d'injection de dépendances.
    public function getStudents(UserRepository $repo, SerializerInterface $serializer)
    {
        $user = $repo->findAll();
        //* Nous utilisons la fonction normalize qui transforme le tableau d'objets 
        //* students en  tableau associatif simple.
        // $studentsNormalises = $normalizer->normalize($students, 'json', ['groups' => "students"]);

        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        // $json = json_encode($studentsNormalises);

        $json = $serializer->serialize($user, 'json', ['groups' => "user"]);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }

    #[Route("/user/{id}", name: "user")]
    public function UserId($id, NormalizerInterface $normalizer, UserRepository $repo)
    {
        $user = $repo->find($id);
        $userNormalises = $normalizer->normalize($user, 'json', ['groups' => "user"]);
        return new Response(json_encode($userNormalises));
    }

    #[Route("addUserJSON/new", name: "addUserJSON")]
    public function addStudentJSON(Request $req,   NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $user = new user();

        $user->setEmail($req->get('email'));
        $user->setFullName($req->get('full_name'));
        $user->setAddress($req->get('address'));
        $user->setPassword($req->get('password'));
        
        
        $em->persist($user);
        $em->flush();

        $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'user']);
        return new Response(json_encode($jsonContent));
    }

    #[Route("updateUserJSON/{id}", name: "updateUserJSON")]
    public function updateUserJSON(Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $user->setEmail($req->get('email'));
        $user->setFullName($req->get('full_name'));
        $user->setPassword($req->get('password'));

        $em->flush();

        $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'user']);
        return new Response("user updated successfully " . json_encode($jsonContent));
    }

    #[Route("deleteUserJSON/{id}", name: "deleteUserJSON")]
    public function deleteUserJSON(Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $em->remove($user);
        $em->flush();
        $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'user']);
        return new Response("user deleted successfully " . json_encode($jsonContent));
    }

}
