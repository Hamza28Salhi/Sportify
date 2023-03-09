<?php

namespace App\Controller;


use Dompdf\Dompdf;
use \setasign\Fpdi\Fpdi;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Dompdf\FrameReflower\Image;


use App\Service\FileUploader;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Knp\Component\Pager\PaginatorInterface;



use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    #[Route('/produit/addP', name: 'produit_add')]
    public function addProduit(ManagerRegistry $doctrine,Request $req, FileUploader $fileUploader): Response {
        $em = $doctrine->getManager();
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($req);

        
        if($form->isSubmitted() && $form->isValid())
            {
    
                $file = $form['image']->getData();
                if ($file) {
                    $fileName = $fileUploader->upload($file);
                    $produit->setImage($fileName);
                }
               
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('produit_afficheP');
        }
        return $this->renderForm('produit/addP.html.twig',['form'=>$form]);
}

#[Route('/produit/afficheP/{sortBy}/{sortOrder<[^/]+>}', name: 'produit_afficheP')]
public function afficheP(ManagerRegistry $doctrine, $sortBy = 'id', $sortOrder = 'asc'): Response {
    $em = $doctrine->getManager();
    $sortOrder = str_replace('/', '', $sortOrder);
    $produit = $em->getRepository(Produit::class)->findAllOrderedByProperty($sortBy, $sortOrder);

    return $this->render('produit/afficheP.html.twig', ['produit' => $produit]);
}






#[Route('/produit/affichePP/{sortBy}/{sortOrder<[^/]+>}', name: 'produit_affichePP')]
public function affichePP(Request $request, ManagerRegistry $doctrine, $sortBy = 'id', $sortOrder = 'asc'): Response {
    $em = $doctrine->getManager();
    $sortOrder = str_replace('/', '', $sortOrder);
    
    // Pagination
    $perPage = 8; // Nombre de produits par page
    $currentPage = $request->query->getInt('page', 1); // Numéro de la page courante, 1 si non défini
    $offset = ($currentPage - 1) * $perPage; // Offset pour la requête
    
    $queryBuilder = $em->createQueryBuilder();
    $queryBuilder->select('p')
        ->from(Produit::class, 'p')
        ->orderBy('p.'.$sortBy, $sortOrder)
        ->setFirstResult($offset)
        ->setMaxResults($perPage);
    
    $query = $queryBuilder->getQuery();
    $produit = $query->getResult();
    
    $totalProduit = $em->getRepository(Produit::class)->count([]); // Nombre total de produits
    $totalPages = ceil($totalProduit / $perPage); // Nombre total de pages

    return $this->render('produit/affichePP.html.twig', [
        'produit' => $produit,
        'totalPages' => $totalPages,
        'currentPage' => $currentPage
    ]);
}



#[Route('/produit/afficheCP/{id}', name: 'produit_afficheCP')]
public function afficheCP(ManagerRegistry $doctrine, $id): Response {
    $em = $doctrine->getManager();
    $produit = $em->getRepository(Produit::class)->find($id);
    
    if (!$produit) {
        throw $this->createNotFoundException('Produit not found');
    }

    return $this->render('produit/afficheCP.html.twig', ['produit' => $produit]);
}



#[Route('/produit/{id}/delete', name: 'produit_delete')]
public function produit(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $produit = $em->getRepository(Produit::class)->find($id);

    if (!$produit) {
        throw $this->createNotFoundException('The produit was not found');
    }

    $em->remove($produit);
    $em->flush();

    return $this->redirectToRoute('produit_afficheP');
}


#[Route('/produit/update/{id}', name: 'produit_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id, FileUploader $fileUploader): Response
{
    $em = $doctrine->getManager();
    $produit = $em->getRepository(Produit::class)->find($id);

    if (!$produit) {
        throw new NotFoundHttpException('produit not found');
    }

    $form = $this->createForm(ProduitType::class, $produit);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $file = $form['image']->getData();
        if ($file) {
            $newFileName = $fileUploader->upload($file);
            $produit->setImage($newFileName);
        }
        $em->flush();

        return $this->redirectToRoute('produit_afficheP');
    }

    return $this->render('produit/update.html.twig', [
        'produit' => $produit,
        'form' => $form->createView(),
    ]);

}




#[Route('/produit/recherche', name: 'produit_recherche')]
public function searchProduit(Request $request, PaginatorInterface $paginator)
{
    $searchTerm = $request->query->get('searchTerm');
    $em = $this->getDoctrine()->getManager();

    $queryBuilder = $em->getRepository(Produit::class)->createQueryBuilder('p');
    $queryBuilder->where('p.nom_produit LIKE :searchTerm')
        ->orWhere('p.prix_produit LIKE :searchTerm')
        ->orWhere('p.marque_produit LIKE :searchTerm')
        ->orWhere('p.categorie LIKE :searchTerm')
        ->setParameter('searchTerm', '%' . $searchTerm . '%')
        ->orderBy('p.id', 'ASC');

    $pagination = $paginator->paginate(
        $queryBuilder, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        5 /*limit per page*/
    );

    return $this->render('produit/search.html.twig', ['pagination' => $pagination]);
}




 
    
    

#[Route('/pdf', name: 'pdf', methods: ['GET'])]
public function pdf(ProduitRepository $ProduitRepository): Response
{
    // Configure Dompdf according to your needs
    $pdfOptions = new OptionsResolver();
    $pdfOptions->setDefaults([
        'defaultFont' => 'Arial',
        'tempDir' => sys_get_temp_dir(), // specify the temp directory explicitly
    ]);

    // Instantiate Dompdf with our options
    $dompdf = new Dompdf($pdfOptions);

    // Retrieve the HTML generated in our twig file
    $html = $this->renderView('produit/pdf.html.twig', [
        'produits' => $ProduitRepository->findAll(),
    ]);

    // Load HTML to Dompdf
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser (inline view)
    $output = $dompdf->output();
    $response = new Response($output);
    $response->headers->set('Content-Type', 'application/pdf');
    $response->headers->set('Content-Disposition', 'inline; filename="mypdf.pdf"');
    return $response;
}








    #[Route('/produit/statistics', name: 'produits_statistics')]
    public function statistics(ManagerRegistry $doctrine): Response {
        $em = $doctrine->getManager();
        $ProduitRepository = $em->getRepository(Produit::class);
    
        // Get the total number of produits
        $totalProduits = $ProduitRepository->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->getQuery()
            ->getSingleScalarResult();
    
        // Get the number of produits per category
        $categoryProduits = $ProduitRepository->createQueryBuilder('p')
            ->select('c.nom_categorie AS categoryName', 'COUNT(p.id) AS produitCount')
            ->leftJoin('p.categorie', 'c')
            ->groupBy('c.id')
            ->getQuery()
            ->getResult();
    
        return $this->render('produit/statistics.html.twig', [
            'totalProduits' => $totalProduits,
            'categoryProduits' => $categoryProduits,
        ]);
    }






   

}
