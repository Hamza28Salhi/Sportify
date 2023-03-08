<?php

namespace App\Controller;
use App\Entity\Reservation;
use App\Form\FormReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ReservationRepository;
use Endroid\QrCode\Builder\BuilderInterface;
use App\Form\FormReservationFrontType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;



class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }

    


    #[Route('/exportexcel', name: 'exportexcel')]
    public function exportProductsToExcelAction(): Response
    {

        // Récupérer la liste des produits depuis votre source de données
        $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findAll();

        // Créer un nouveau document Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('reservations');

        // Écrire les en-têtes de colonnes
        $sheet->setCellValue('A1', 'nom');
        $sheet->setCellValue('B1', 'prenom');
        $sheet->setCellValue('C1', 'adresse ');
        $sheet->setCellValue('D1', 'telephone ');
        $sheet->setCellValue('E1', 'paiement ');
      

        // Écrire les données des produits
        $row = 2;
        foreach ($reservations as $reservation) {
            $sheet->setCellValue('A'.$row, $reservation->getNom());
            $sheet->setCellValue('B'.$row, $reservation->getPrenom());
            $sheet->setCellValue('C'.$row, $reservation->getAdresse());
            $sheet->setCellValue('D'.$row, $reservation->getTelephone());
            $sheet->setCellValue('E'.$row, $reservation->getPaiement());
           
            $row++;
        }

        // Créer une réponse HTTP pour le document Excel
        $response = new Response();



        // Écrire le document Excel dans la réponse HTTP
        $writer = new Xlsx($spreadsheet);
        $writer->save('listeEvenements.xlsx');

        return $response;
    }

    #[Route('/reservation/add', name: 'reservation_add')]
    public function addReservation(ManagerRegistry $doctrine,Request $req): Response 
    {    
    
        $em = $doctrine->getManager();
        $reservation = new Reservation();
        $form = $this->createForm(FormReservationType::class,$reservation);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('reservation_list');
        }

        return $this->renderForm('reservation/addR.html.twig',['form'=>$form]);
    }

    #[Route('/reservation/addFront', name: 'reservation_addFront')]
    public function addReservationFront(ManagerRegistry $doctrine,Request $req): Response 
    {    
    
        $em = $doctrine->getManager();
        $reservation = new Reservation();
        $form = $this->createForm(FormReservationFrontType::class,$reservation);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            
            $email =(new Email())
            ->from('symfonycopte822@gmail.com')
            ->to ('houyem.kaaniche@esprit.tn')
            ->subject('ASTRAL SPORTIFY')
            ->text('Votre réservation est enregistrée');
            $transport= new GmailSmtpTransport('symfonycopte822@gmail.com','cdwgdrevbdoupxhn');
            $mailer= new Mailer($transport);
            $mailer->send($email);

            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('reservation_list');
        }

        return $this->renderForm('reservation/addFront.html.twig',['frontform'=>$form]);
    }

    

    #[Route('/reservation/list', name: 'reservation_list')]
    public function list(ManagerRegistry $doctrine): Response {
        $em = $doctrine->getManager();
        $Reservation = $em->getRepository(Reservation::class)->findAll();
    
        return $this->render('reservation/listR.html.twig', ['reservation' => $Reservation]);
    }

    #[Route('/reservation/{id}/delete', name: 'reservation_delete')]
public function delete(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $Reservation = $em->getRepository(Reservation::class)->find($id);

    if (!$Reservation) {
        throw $this->createNotFoundException('The reservation was not found');
    }

    $em->remove($Reservation);
    $em->flush();

    return $this->redirectToRoute('reservation_list');
}

#[Route('/reservation/update/{id}', name: 'reservation_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $Reservation = $em->getRepository(Reservation::class)->find($id);

   

    $form = $this->createForm(FormReservationType::class, $Reservation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();

        return $this->redirectToRoute('reservation_list');
    }

    return $this->render('reservation/updateR.html.twig', [
        'reservation' => $Reservation,
        'form' => $form->createView(),
    ]);
}




}
