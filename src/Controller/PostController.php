<?php

namespace App\Controller;

/*use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Common\Collections\ArrayCollection;*/

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostType;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    #[Route('/post/post_add', name: 'post_add')]
    public function addPost(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $post = new Post();
        $form = $this->createForm(PostType::class,$post);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $post->setDateCreationPost(new \DateTime()); 
            
            $imageFile = $form['image_Post']->getData();
            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();
                try {
                    $imageFile->move(
                    $this->getParameter('post_images_directory'),
                    $newFilename
                    );
                } catch (FileException $e) {
                
                    // gérer les erreurs ici si nécessaire
                }
                $post->setImagePost($newFilename);
            }


            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('post_show');
        }

        return $this->renderForm('post/post_add.html.twig',['form'=>$form]);
    }
  
    
//afficher les posts en back
    #[Route('/post/post_show', name: 'post_show')]
public function list(ManagerRegistry $doctrine): Response {
    $em = $doctrine->getManager();
    $post = $em->getRepository(Post::class)->findAll();

    return $this->render('post/post_show.html.twig', ['post' => $post]);
}

//afficher les posts en front
#[Route('/post/post_show_front', name: 'post_show_front')]
public function showF(ManagerRegistry $doctrine): Response {
    $em = $doctrine->getManager();
    $post = $em->getRepository(Post::class)->findAll();

    return $this->render('post/post_show_front.html.twig', ['post' => $post]);
}

//afficher le post selectionné en front
#[Route('/post/post_show_one/{id}', name: 'post_show_one')]
public function showO(Request $request, ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $post = $em->getRepository(Post::class)->find($id);
    $commentaires = new Commentaire();
    //$commentaires->setDateCreationCommentaire(new \DateTime());
    $form = $this->createForm(CommentaireType::class,$commentaires);
    //$form->handleRequest($req);
    if ($form->isSubmitted() && $form->isValid()) {
        $commentaires = $form->getData();
        $commentaires->setDateCreationCommentaire(new \DateTime());
        $commentaires->setPost($post); // On associe le commentaire au post
        $em->persist($commentaires);
        $em->flush();
        return $this->redirectToRoute('post_show_one', ['id' => $id]);
    }
    if (!$post) {
        throw $this->createNotFoundException('The post was not found');
    }

    //$content = $post->getContenuPost();
    //$parts = explode("\n", $content, 3);
    /*foreach ($parts as $part) {
        echo '<p>' . trim($part) . '</p>';
    }*/
    return $this->render('post/post_show_one.html.twig', [
        'post' => $post,
        'commentaires' => $commentaires,
        'form' => $form->createView(),
    ]);
    //'parts' => $parts,
}



#[Route('/post/{id}/post_delete', name: 'post_delete')]
public function delete(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $post = $em->getRepository(Post::class)->find($id);

    if (!$post) {
        throw $this->createNotFoundException('The post was not found');
    }

    $em->remove($post);
    $em->flush();

    return $this->redirectToRoute('post_show');
}

#[Route('/post/post_update/{id}', name: 'post_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $post = $em->getRepository(Post::class)->find($id);

    if (!$post) {
        throw new NotFoundHttpException('post not found');
    }

    $form = $this->createForm(PostType::class, $post);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $post = $form->getData();
        $post->setDateCreationPost(new \DateTime());
        $file = $form['image_Post']->getData();
        //$file = $form->get('image_Post')->getData();
        if ($file) {
            // Supprimer l'ancienne image
            $oldFile = $post->getImagePost();
            if ($oldFile) {
                $filePath = $this->getParameter('post_images_directory') . '/' . $oldFile;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Enregistrer la nouvelle image
            $fileName = uniqid() . '.' . $file->guessExtension();
            $file->move(
                $this->getParameter('post_images_directory'),
                $fileName
            );
            $post->setImagePost($fileName);
        }



        $em->flush();

        return $this->redirectToRoute('post_show');
        //return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
    }

    return $this->render('post/post_update.html.twig', [
        'post' => $post,
        'form' => $form->createView(),
    ]);
}

/**
 * @Route("/post/{id}/commentaires", name="post_commentaires")
 */
public function showCommentaires(Post $post): Response
{
    $commentaires = $post->getCommentaires();

    return $this->render('post/p_c.html.twig', [
        'post' => $post,
        'commentaires' => $commentaires,
    ]);
}

/*#[Route('/post/{id}/p_c_delete', name: 'p_c_delete')]
public function p_c_delete(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();removeCommentaire(Commentaire $commentaire)
    $post = $em->getRepository(Post::class)->find($id);

    if (!$post) {
        throw $this->createNotFoundException('The post was not found');
    }

    $em->remove($post);
    $em->flush();

    return $this->redirectToRoute('post_show');
}

//Section post: commenaires du post: supprimer un commentaire
#[Route('/commentaire/{id}/commentaire_post_delete', name: 'commentaire_post_delete')]
public function c_p_delete(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $commentaire = $em->getRepository(Commentaire::class)->find($id);

    if (!$commentaire) {
        throw $this->createNotFoundException('The commentaire was not found');
    }

    $em->remove($commentaire);
    $em->flush();

    return $this->render('post/p_c.html.twig', [
        'id' => $id,
    ]);
}*/

}
