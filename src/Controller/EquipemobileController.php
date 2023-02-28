<?php

namespace App\Controller;
use App\Repository\EquipeRepository;
use App\Entity\Equipe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\Persistence\ManagerRegistry; 

class EquipemobileController extends AbstractController
{
    #[Route('/equipemobile', name: 'app_equipemobile')]
    public function index(): Response
    {
        return $this->render('equipemobile/index.html.twig', [
            'controller_name' => 'EquipemobileController',
        ]);
    }



    #[Route("/equipemobile/list", name: "list")]
    //* Dans cette fonction, nous utilisons les services NormlizeInterface et StudentRepository, 
    //* avec la méthode d'injection de dépendances.
    public function getEquipes(EquipeRepository $repo, SerializerInterface $serializer)
    {
        $equipes = $repo->findAll();
        //* Nous utilisons la fonction normalize qui transforme le tableau d'objets 
        //* students en  tableau associatif simple.
        // $studentsNormalises = $normalizer->normalize($students, 'json', ['groups' => "students"]);


        
        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        // $json = json_encode($studentsNormalises);

        $json = $serializer->serialize($equipes, 'json', ['groups' => "equipes"]);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }

    #[Route("/equipemobile/{id}", name: "equipe")]
    public function EquipeId($id, NormalizerInterface $normalizer, EquipeRepository $repo)
    {
        $equipe = $repo->find($id);
        $equipeNormalises = $normalizer->normalize($equipe, 'json', ['groups' => "equipes"]);
        return new Response(json_encode($equipeNormalises));
    }

    #[Route("addEquipeJSON/new", name: "addEquipeJSON")]
    public function addEquipeJSON(ManagerRegistry $doctrine, Request $req,   NormalizerInterface $Normalizer)
    {

        $em = $doctrine->getManager();
        $equipe = new Equipe();
        $equipe->setNom($req->get('nom'));
        $equipe->setJoueurs($req->get('joueurs'));
        $equipe->setClassement($req->get('classement'));
        $equipe->setEntraineur($req->get('entraineur'));
        $equipe->setCategorie($req->get('categorie'));
        $em->persist($equipe);
        $em->flush();

        $jsonContent = $Normalizer->normalize($equipe, 'json', ['groups' => 'equipes']);
        return new Response(json_encode($jsonContent));
    }
    #[Route("updateEquipeJSON/{id}", name: "updateEquipeJSON")]
    public function updateEquipeJSON(ManagerRegistry $doctrine, Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $doctrine->getManager();
        $equipe = $em->getRepository(Equipe::class)->find($id);
             $equipe->setNom($req->get('nom'));
        $equipe->setJoueurs($req->get('joueurs'));
        $equipe->setClassement($req->get('classement'));
        $equipe->setEntraineur($req->get('entraineur'));
        $equipe->setCategorie($req->get('categorie'));


        $em->flush();

        $jsonContent = $Normalizer->normalize($equipe, 'json', ['groups' => 'equipes']);
        return new Response("Equipe updated successfully " . json_encode($jsonContent));
    }

    #[Route("deleteEquipeJSON/{id}", name: "deleteEquipeJSON")]
    public function deleteEquipeJSON(ManagerRegistry $doctrine, Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $doctrine->getManager();
        $equipe = $em->getRepository(Equipe::class)->find($id);
        $em->remove($equipe);
        $em->flush();
        $jsonContent = $Normalizer->normalize($equipe, 'json', ['groups' => 'equipes']);
        return new Response("Equipe deleted successfully " . json_encode($jsonContent));
    }












}
