<?php


namespace App\Controller;
use App\services\QrcodeService;
use App\Repository\AbonnementRepository;

use App\Entity\Abonnement;
use App\Form\AbonnementType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;




class AbonnementController extends AbstractController
{
    #[Route('/front', name: 'front')]
    public function front(): Response
    {

        return $this->render('abonnement/front.html.twig');
    }


    #[Route('/abonnement', name: 'app_abonnement')]
    public function index(): Response
    {
        return $this->render('abonnement/index.html.twig', [
            'controller_name' => 'AbonnementController',
        ]);
    }
    #[Route('/abonnement/add', name: 'abonnement_add')]
    public function addAbonnement(ManagerRegistry $doctrine,Request $req,FlashyNotifier $flashy): Response {
        $em = $doctrine->getManager();
        $abonnement = new Abonnement();
        $form = $this->createForm(AbonnementType::class,$abonnement);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
           
            $em->persist($abonnement);
            $em->flush();
            $flashy->error('Event created!', 'http://your-awesome-link.com');

            return $this->redirectToRoute('abonnement_add');
        }

        return $this->renderForm('abonnement/add.html.twig',['form'=>$form]);
    }
    #[Route('/abonnement/list', name: 'abonnement_list')]
    public function list(AbonnementRepository $abonnementRepository,PaginatorInterface $paginator,Request $request): Response {
        $data = $abonnementRepository->findAll();
        $abonnement = $paginator->paginate(
            $data, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
           6 /*limit per page*/
        );
        
    
        return $this->render('abonnement/list.html.twig', ['abonnement' => $abonnement]);
    }
    #[Route('/abonnement/{id}/delete', name: 'abonnement_delete')]
public function delete(ManagerRegistry $doctrine, int $id,FlashyNotifier $flashy): Response
{
    $em = $doctrine->getManager();
    $abonne = $em->getRepository(Abonnement::class)->find($id);

    if (!$abonne) {
        throw $this->createNotFoundException('The membership was not found');
    }

    $em->remove($abonne);
    $em->flush();
    $flashy->error('Event created!', 'http://your-awesome-link.com');

    return $this->redirectToRoute('abonnement_list');
}

#[Route('/abonnement/update/{id}', name: 'abonnement_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $abonne = $em->getRepository(abonnement::class)->find($id);

    if (!$abonne) {
        throw new NotFoundHttpException('membership not found');
    }

    $form = $this->createForm(AbonnementType::class, $abonne);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();

        return $this->redirectToRoute('abonnement_list');
    }

    return $this->render('abonnement/update.html.twig', [
        'abonne' => $abonne,
        'form' => $form->createView(),
    ]);
}
    

}
