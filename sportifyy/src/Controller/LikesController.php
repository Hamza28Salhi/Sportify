<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LikesController extends AbstractController
{
    /**
     * @Route("/likes/{id}", name="app_likes")
     */
    public function like($id, EntityManagerInterface $entityManager): Response
    {
        $postRepository = $this->getDoctrine()->getRepository(Post::class);
        $post = $postRepository->find($id);

        $likes = $post->getLikes();
        $likes++;
        $post->setLikes($likes);

        $entityManager->persist($post);
        $entityManager->flush();

        return $this->redirectToRoute('post_show_front', ['id' => $id]);
    }

    /**
     * @Route("/dislikes/{id}", name="app_dislikes")
     */
    public function dislike($id, EntityManagerInterface $entityManager): Response
    {
        $postRepository = $this->getDoctrine()->getRepository(Post::class);
        $post = $postRepository->find($id);

        $dislike = $post->getDislike();
        $dislike++;
        $post->setDislike($dislike);

        $entityManager->persist($post);
        $entityManager->flush();

        return $this->redirectToRoute('post_show_front', ['id' => $id]);
    }
}