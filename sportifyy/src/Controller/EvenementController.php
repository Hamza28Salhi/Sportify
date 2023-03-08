<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\FormEvenementType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\EvenementRepository;
use App\Entity\Reservation;
use App\Form\FormReservationType;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile ;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Writer\PngWriter;





class EvenementController extends AbstractController
{
    #[Route('/evenement', name: 'app_evenement')]
    public function index(): Response
    {
        return $this->render('evenement/index.html.twig', [
            'controller_name' => 'EvenementController',
        ]);
    }

    

    #[Route('/evenement/add', name: 'evenement_add')]
    public function addEvenement(ManagerRegistry $doctrine,Request $req,FileUploader $fileUploader): Response {
        $em = $doctrine->getManager();
        $Evenement = new Evenement();
        $form = $this->createForm(FormEvenementType::class,$Evenement);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $file = $form['even_pic']->getData();
            if ($file) {
                $fileName = $fileUploader->upload($file);
                $Evenement->setEvenPic($fileName);
            }
            $em->persist($Evenement);
            $em->flush();
            return $this->redirectToRoute('evenement_list');
        }

        return $this->renderForm('evenement/add.html.twig',['form'=>$form]);
    }


    #[Route('/evenement/list', name: 'evenement_list')]
    public function list(ManagerRegistry $doctrine): Response {
        $em = $doctrine->getManager();
        $evenement = $em->getRepository(Evenement::class)->findAll();
    
        return $this->render('evenement/list.html.twig', ['evenement' => $evenement]);
    }

    #[Route('/evenement/listE', name: 'evenement_listE')]
    public function listE(ManagerRegistry $doctrine): Response {
        $em = $doctrine->getManager();
        $evenement = $em->getRepository(Evenement::class)->findAll();
    
        return $this->render('evenement/listE.html.twig', ['evenement' => $evenement]);
    }

   

    #[Route('/evenement/{id}/delete', name: 'evenement_delete')]
public function delete(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $evenement = $em->getRepository(Evenement::class)->find($id);

    if (!$evenement) {
        throw $this->createNotFoundException('The evenment was not found');
    }

    $em->remove($evenement);
    $em->flush();

    return $this->redirectToRoute('evenement_list');
}

#[Route('/evenement/update/{id}', name: 'evenement_update')]
public function update(ManagerRegistry $doctrine, Request $request, $id,FileUploader $fileUploader): Response
{
    $em = $doctrine->getManager();
    $evenement = $em->getRepository(Evenement::class)->find($id);

   

    $form = $this->createForm(FormEvenementType::class, $evenement);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $file = $form['even_pic']->getData();
            if ($file) {
                $fileName = $fileUploader->upload($file);
                $evenement->setEvenPic($fileName);
            }
        $em->flush();

        return $this->redirectToRoute('evenement_list');
    }

    return $this->render('evenement/update.html.twig', [
        'evenement' => $evenement,
        'form' => $form->createView(),
    ]);
}

#[Route(path: '/profile', name: 'home')]
    public function home(EvenementRepository $evenement,ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $EvenementRepository = $em->getRepository(Evenement::class);
        return $this->render('evenement/listE.html.twig', [
            'evenement' => $evenement,
            
        ]);
    }

    #[Route('/notyf', name: 'app_notyf')]
    public function index1(?string $notyf=null): Response
    {
        return $this->render('evenement/notyf.html.twig', [
            'evenement' => $notyf,
           
        ]);
    }


    #[Route('/confirmation', name: 'confirmation')]
    public function confirmation(EvenementRepository $r): Response
                {
                        //$e=$r->findAll();
                       // $ejson=$serializer->serialize($e, 'json', ['groups' => "er"]);
                        $qrCode=Builder::create()
                            ->writer(new PngWriter())
                            ->writerOptions([])
                            ->data("Cette personne est autorisée de faire partie de l'événement!")
                            ->encoding(new Encoding('UTF-8'))
                            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                            ->size(300)
                            ->margin(10)
                            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
                            ->labelText("")
                            ->labelFont(new NotoSans(20))
                            ->labelAlignment(new LabelAlignmentCenter())
                            ->build();
                
                        return $this->render('evenement/confirmation.html.twig', [
                            'qr'=>$qrCode->getDataUri()]);
                    }
    
   
}

   



