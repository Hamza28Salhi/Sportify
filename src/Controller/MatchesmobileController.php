<?php

namespace App\Controller;
use App\Repository\MatchesRepository;
use App\Entity\Matches;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\Persistence\ManagerRegistry; 

class MatchesmobileController extends AbstractController
{
    #[Route('/matchesmobile', name: 'app_matchesmobile')]
    public function index(): Response
    {
        return $this->render('matchesmobile/index.html.twig', [
            'controller_name' => 'MatchesmobileController',
        ]);
    }


    #[Route("/matchesmobile/list", name: "liste")]
    //* Dans cette fonction, nous utilisons les services NormlizeInterface et StudentRepository, 
    //* avec la méthode d'injection de dépendances.
    public function getMatches(MatchesRepository $repo, SerializerInterface $serializer)
    {
        $matches = $repo->findAll();
        
        //* Nous utilisons la fonction normalize qui transforme le tableau d'objets 
        //* students en  tableau associatif simple.
        // $studentsNormalises = $normalizer->normalize($students, 'json', ['groups' => "students"]);


        
        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        // $json = json_encode($studentsNormalises);

        $json = $serializer->serialize($matches, 'json', ['groups' => "matches","equipes"]);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }

    #[Route("/matchesmobile/{id}", name: "matche")]
    public function MatchesId($id, NormalizerInterface $normalizer, MatchesRepository $repo)
    {
        $matches = $repo->find($id);
        $matchesNormalises = $normalizer->normalize($matches, 'json', ['groups' => "matches"]);
        return new Response(json_encode($matchesNormalises));
    }

    #[Route("addMatchesJSON/new", name: "addMatchesJSON")]
    public function addMatchesJSON(ManagerRegistry $doctrine, Request $req,   NormalizerInterface $Normalizer)
    {

        $em = $doctrine->getManager();
        $matches = new Matches();
        $matches->setNom($req->get('nom'));
        $matches->setStade($req->get('stade'));
        $matches->setLatitude($req->get('latitude'));
        $matches->setLongitude($req->get('longitude'));
        $matches->setScore($req->get('score'));
        $dateString = $req->get('date');
        $date = \DateTime::createFromFormat('Y-m-d', $dateString); // assuming the date string is in the format 'YYYY-MM-DD'
        $matches->setDate($date);
        $equipeRepository = $em->getRepository(Equipe::class);
        $equipe = $equipeRepository->findOneBy(['nom' => $req->get('nom_equipe')]);
        $matches->setNomEquipe($equipe);

        $em->persist($matches);
        $em->flush();

        $jsonContent = $Normalizer->normalize($matches, 'json', ['groups' => 'matches','equipes']);
        return new Response(json_encode($jsonContent));
    }
    #[Route("updateMatchesJSON/{id}", name: "updateMatchesJSON")]
    public function updateMatchesJSON(ManagerRegistry $doctrine, Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $doctrine->getManager();
        $matches = $em->getRepository(Matches::class)->find($id);
             $matches->setNom($req->get('nom'));
        $matches->setStade($req->get('stade'));
        $dateString = $req->get('date');
        $date = \DateTime::createFromFormat('Y-m-d', $dateString); // assuming the date string is in the format 'YYYY-MM-DD'
        $matches->setDate($date);
        $matches->setLatitude($req->get('latitude'));
        $matches->setLongitude($req->get('longitude'));
        $matches->setScore($req->get('score'));
        $equipeRepository = $em->getRepository(Equipe::class);
        $equipe = $equipeRepository->findOneBy(['nom' => $req->get('nom_equipe')]);
        $matches->setNomEquipe($equipe);
    



        $em->flush();

        $jsonContent = $Normalizer->normalize($matches, 'json', ['groups' => 'matches']);
        return new Response("Matches updated successfully " . json_encode($jsonContent));
    }

    #[Route("deleteMatchesJSON/{id}", name: "deleteMatchesJSON")]
    public function deleteMatchesJSON(ManagerRegistry $doctrine, Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $doctrine->getManager();
        $matches = $em->getRepository(Matches::class)->find($id);
        $em->remove($matches);
        $em->flush();
        $jsonContent = $Normalizer->normalize($matches, 'json', ['groups' => 'matches']);
        return new Response("Matches deleted successfully " . json_encode($jsonContent));
    }

}
