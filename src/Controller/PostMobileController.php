<?php

namespace App\Controller;
use App\Repository\PostRepository;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\Persistence\ManagerRegistry; 
use Symfony\Component\Serializer\Annotation\Groups;


class PostMobileController extends AbstractController
{
    #[Route('/post/postmobile', name: 'app_postmobile')]
    public function index(): Response
    {
        return $this->render('postmobile/index.html.twig', [
            'controller_name' => 'PostmobileController',
        ]);
    }



    #[Route("/post/postmobile/list", name: "list")]
    //* Dans cette fonction, nous utilisons les services NormlizeInterface et StudentRepository, 
    //* avec la méthode d'injection de dépendances.
    public function getPosts(PostRepository $repo, SerializerInterface $serializer)
    {
        $posts = $repo->findAll();
        //* Nous utilisons la fonction normalize qui transforme le tableau d'objets 
        //* students en  tableau associatif simple.
        // $studentsNormalises = $normalizer->normalize($students, 'json', ['groups' => "students"]);


        
        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        // $json = json_encode($studentsNormalises);

        $json = $serializer->serialize($posts, 'json', ['groups' => "posts"]);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }

    #[Route("/post/postmobile/{id}", name: "post")]
    public function PostId($id, NormalizerInterface $normalizer, PostRepository $repo)
    {
        $post = $repo->find($id);
        $postNormalises = $normalizer->normalize($post, 'json', ['groups' => "posts"]);
        return new Response(json_encode($postNormalises));
    }

    #[Route("/post/addPostJSON/new", name: "addPostJSON")]
    public function addPostJSON(ManagerRegistry $doctrine, Request $req,   NormalizerInterface $Normalizer)
    {
        
        $em = $doctrine->getManager();
        $post = new Post();
        $post->setTitrePost($req->get('titre_Post'));
        $post->setContenuPost($req->get('contenu_Post'));
        $post->setAuteurPost($req->get('auteur_Post'));
        $post->setDateCreationPost(new \DateTime());

        $em->persist($post);
        $em->flush();

        $jsonContent = $Normalizer->normalize($post, 'json', ['groups' => 'posts']);
        return new Response(json_encode($jsonContent));
    }
    #[Route("/post/updatePostJSON/{id}", name: "updatePostJSON")]
    public function updatePostJSON(ManagerRegistry $doctrine, Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $doctrine->getManager();
        $post = $em->getRepository(Post::class)->find($id);
        $post->setTitrePost($req->get('titre_Post'));
        $post->setContenuPost($req->get('contenu_Post'));
        $post->setAuteurPost($req->get('auteur_Post'));
        $post->setDateCreationPost(new \DateTime());


        $em->flush();

        $jsonContent = $Normalizer->normalize($post, 'json', ['groups' => 'posts']);
        return new Response("Post updated successfully " . json_encode($jsonContent));
    }

    #[Route("/post/deletePostJSON/{id}", name: "deletePostJSON")]
    public function deletePostJSON(ManagerRegistry $doctrine, Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $doctrine->getManager();
        $post = $em->getRepository(Post::class)->find($id);
        $em->remove($post);
        $em->flush();
        $jsonContent = $Normalizer->normalize($post, 'json', ['groups' => 'posts']);
        return new Response("Post deleted successfully " . json_encode($jsonContent));
    }












}