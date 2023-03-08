<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Repository\AbonnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AbonnementMobileController extends AbstractController
{
    #[Route('/abonnement/abonnement', name: 'app_abonnement_mobile')]
    public function index(): Response
    {
        return $this->render('abonnement_mobile/index.html.twig', [
            'controller_name' => 'AbonnementMobileController',
        ]);
    }

    #[Route("/AllAbonnements", name: "list")]
    //* Dans cette fonction, nous utilisons les services NormlizeInterface et StudentRepository, 
    //* avec la méthode d'injection de dépendances.
    public function getStudents(AbonnementRepository $repo, SerializerInterface $serializer)
    {
        $abonnements = $repo->findAll();
        //* Nous utilisons la fonction normalize qui transforme le tableau d'objets 
        //* students en  tableau associatif simple.
        // $studentsNormalises = $normalizer->normalize($students, 'json', ['groups' => "students"]);

        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        // $json = json_encode($studentsNormalises);

        $json = $serializer->serialize($abonnements, 'json', ['groups' => "abonnements"]);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }

    #[Route("/abonnement/{id}", name: "abonnement")]
    public function AbonnementId($id, NormalizerInterface $normalizer, AbonnementRepository $repo)
    {
        $abonnement = $repo->find($id);
        $abonnementNormalises = $normalizer->normalize($abonnement, 'json', ['groups' => "abonnements"]);
        return new Response(json_encode($abonnementNormalises));
    }

    #[Route("addAbonnementJSON/new", name: "addAbonnementJSON")]
    public function addStudentJSON(Request $req,   NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $abonnement = new abonnement();

        $abonnement->setNom($req->get('nom'));
        $abonnement->setDescription($req->get('description'));
        $abonnement->setPrix($req->get('prix'));
        
        
        
        $em->persist($abonnement);
        $em->flush();

        $jsonContent = $Normalizer->normalize($abonnement, 'json', ['groups' => 'abonnements']);
        return new Response(json_encode($jsonContent));
    }

    #[Route("updateAbonnementJSON/{id}", name: "updateAbonnementJSON")]
    public function updateAbonnementJSON(Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $abonnement = $em->getRepository(Abonnement::class)->find($id);
        $abonnement->setNom($req->get('nom'));
        $abonnement->setDescription($req->get('description'));
        $abonnement->setPrix($req->get('prix'));

        $em->flush();

        $jsonContent = $Normalizer->normalize($abonnement, 'json', ['groups' => 'abonnements']);
        return new Response("abonnement updated successfully " . json_encode($jsonContent));
    }

    #[Route("deleteAbonnementJSON/{id}", name: "deleteAbonnementJSON")]
    public function deleteAbonnementJSON(Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $abonnement = $em->getRepository(Abonnement::class)->find($id);
        $em->remove($abonnement);
        $em->flush();
        $jsonContent = $Normalizer->normalize($abonnement, 'json', ['groups' => 'abonnements']);
        return new Response("abonnement deleted successfully " . json_encode($jsonContent));
    }

}