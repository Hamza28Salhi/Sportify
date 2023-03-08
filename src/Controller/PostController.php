<?php

namespace App\Controller;

/*use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Common\Collections\ArrayCollection;*/


use App\Service\CommentModerationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostType;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Form\CommentaireFrontType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{

    ////////////////////////////////////BUNDLE NOTIF: injection de  NotifierInterface////////////////////////////////////
    /*private $commentaireRepository;

    public function __construct(CommentaireRepository $commentaireRepository, NotifierInterface $notifier)
    {
        $this->commentaireRepository = $commentaireRepository;
        $this->notifier = $notifier;
    }*/
    ////////////////////////////////////BUNDLE NOTIF: injection de  NotifierInterface////////////////////////////////////
    private $commentaireRepository;

    public function __construct(CommentaireRepository $commentaireRepository)
    {
        $this->commentaireRepository = $commentaireRepository;
    }
    

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
            //$flashy->success('Post created!', 'http://your-awesome-link.com');
            //$this->addFlash('success', 'Notification message');
/* /////////////////////////////////////////////NOTIF AVEC NOTIFIER/////////////////////////////////////////
            $notification = new Notification('Nouveau post ajouté', ['browser']);
            $this->notifier->send($notification);

            // envoyer la notification

                    // Notify users of the new post
                    $this->notifyNewPost($post);



            //$this->notificationService->notifyPostAdded($post);*/
            return $this->redirectToRoute('post_show');
        }


        return $this->renderForm('post/post_add.html.twig',['form'=>$form]);
    }

    /*private function notifyNewPost(Post $post)
    {
        // Retrieve the list of users to notify (in this case, all users)
        //$users = $this->commentaireRepository->findAllUsers();

        //foreach ($users as $user) {
            // Create a notification for each user

            //$notification = new Notification('Nouveau post ajouté', ['email']);
            $notification = new Notification('New post created', ['browser']);
            $notification->content('A new post has been created: '.$post->getTitrePost());

            // Send the notification using the notifier service
            //$this->notifier->send($notification, $user);
            $this->notifier->send($notification);
        //}
    }*/
  
    
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
public function showO(Request $request, ManagerRegistry $doctrine, int $id,CommentaireRepository $commentaireRepository,CommentModerationService $commentModerationService): Response
{
    $em = $doctrine->getManager();
    $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
    $commentaires = $commentaireRepository->findBy(['post' => $post]);
    $commentaire = new Commentaire();
    $commentNotAllowed = false;

    $commentaireFrontForm = $this->createForm(CommentaireFrontType::class, $commentaire);
    $commentaireFrontForm->handleRequest($request);


    if ($commentaireFrontForm->isSubmitted() && $commentaireFrontForm->isValid()) {
        $commentaireContent = $commentaireFrontForm->get('contenu_Commentaire')->getData();
        $commentNotAllowed = !$commentModerationService->checkCommentAllowed($commentaireContent);

        if ($commentNotAllowed) {
            $this->addFlash('danger', 'Votre commentaire contient des propos inappropriés.');
            return $this->redirectToRoute('post_show_one', ['id' => $post->getIdPost(),'commentNotAllowed' => 1]);
        }

        $commentaire->setPost($post);
        $entityManager = $this->getDoctrine()->getManager();
        $commentaire->setDateCreationCommentaire(new \DateTime());
        $entityManager->persist($commentaire);
        $entityManager->flush();

        // Redirection vers la page du post avec le nouveau commentaire
        return $this->redirectToRoute('post_show_one', ['id' => $post->getIdPost(),'commentNotAllowed' => $commentNotAllowed]);
    }

    // Récupération des commentaires du post
    $commentaires = $commentaireRepository->findBy(['post' => $post], ['dateCreation_Commentaire' => 'ASC']);

    return $this->render('post/post_show_one.html.twig', [
        'post' => $post,
        'commentaires' => $commentaires,
        'commentaire_front_form' => $commentaireFrontForm->createView(), // Ajout de la variable contenant le formulaire
        'commentNotAllowed' => $commentNotAllowed,
    ]);
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


    #[Route('/post/statistics', name: 'post_statistics')]
    public function statistics(ManagerRegistry $doctrine): Response {
        $em = $doctrine->getManager();

        // Get the total number of posts
        $totalPosts = $em->getRepository(Post::class)->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->getQuery()
            ->getSingleScalarResult();

        // Get the total number of comments
        $totalComments = $em->getRepository(Commentaire::class)->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->getQuery()
            ->getSingleScalarResult();

        // Get the number of comments per post
        $postComments = $em->getRepository(Post::class)->createQueryBuilder('p')
            ->select('p.titre_Post AS titre_Post', 'COUNT(c.id) AS commentCount')
            ->leftJoin('p.commentaires', 'c')
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();

        return $this->render('post/statistics.html.twig', [
            'totalPosts' => $totalPosts,
            'totalComments' => $totalComments,
            'postComments' => $postComments,
        ]);
    }



}
