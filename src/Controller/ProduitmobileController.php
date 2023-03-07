<?php

namespace App\Controller;
use App\Repository\ProduitRepository;

use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\Persistence\ManagerRegistry; 

class ProduitmobileController extends AbstractController
{
    #[Route('/produitmobile', name: 'app_produitmobile')]
    public function index(): Response
    {
        return $this->render('produitmobile/index.html.twig', [
            'controller_name' => 'ProduitmobileController',
        ]);
    }



    #[Route("/produitmobile/list", name: "list")]
    //* Dans cette fonction, nous utilisons les services NormlizeInterface et StudentRepository, 
    //* avec la méthode d'injection de dépendances.
    public function getProduits(ProduitRepository $repo, SerializerInterface $serializer)
    {
        $produits = $repo->findAll();
        //* Nous utilisons la fonction normalize qui transforme le tableau d'objets 
        //* students en  tableau associatif simple.
        // $studentsNormalises = $normalizer->normalize($students, 'json', ['groups' => "students"]);


        
        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        // $json = json_encode($studentsNormalises);

        $json = $serializer->serialize($produits, 'json', ['groups' => "produits"]);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }

    #[Route("/produitmobile/{id}", name: "produit")]
    public function ProduitId($id, NormalizerInterface $normalizer, ProduitRepository $repo)
    {
        $produit = $repo->find($id);
        $produitNormalises = $normalizer->normalize($produit, 'json', ['groups' => "produits"]);
        return new Response(json_encode($produitNormalises));
    }

    #[Route("addProduitJSON/new", name: "addProduitJSON")]
    public function addProduitJSON(ManagerRegistry $doctrine, Request $req,   NormalizerInterface $Normalizer)
    {

        $em = $doctrine->getManager();
        $produit = new Produit();
        $produit->setNomProduit($req->get('nom_produit'));
        $produit->setPrixProduit($req->get('prix_produit'));
        $produit->setMarqueProduit($req->get('marque_produit'));
      
        $produit->setImage($req->get('image'));
        $produit->setQuantite($req->get('quantite'));
        $em->persist($produit);
        $em->flush();

        $jsonContent = $Normalizer->normalize($produit, 'json', ['groups' => 'produits']);
        return new Response(json_encode($jsonContent));
    }
    #[Route("updateProduitJSON/{id}", name: "updateProduitJSON")]
    public function updateProduitJSON(ManagerRegistry $doctrine, Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $doctrine->getManager();
        $produit = $em->getRepository(Produit::class)->find($id);
        $produit->setNomProduit($req->get('nom_produit'));
        $produit->setPrixProduit($req->get('prix_produit'));
        $produit->setMarqueProduit($req->get('marque_produit'));
        
        $produit->setImage($req->get('image'));
        $produit->setQuantite($req->get('quantite'));


        $em->flush();

        $jsonContent = $Normalizer->normalize($produit, 'json', ['groups' => 'produits']);
        return new Response("Produit updated successfully " . json_encode($jsonContent));
    }

    #[Route("deleteProduitJSON/{id}", name: "deleteProduitJSON")]
    public function deleteProduitJSON(ManagerRegistry $doctrine, Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $doctrine->getManager();
        $produit = $em->getRepository(Produit::class)->find($id);
        $em->remove($produit);
        $em->flush();
        $jsonContent = $Normalizer->normalize($produit, 'json', ['groups' => 'produits']);
        return new Response("Produit deleted successfully " . json_encode($jsonContent));
    }












}