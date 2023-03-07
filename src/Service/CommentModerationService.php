<?php

namespace App\Service;
// src/Service/CommentModerationService.php

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\MotsInterdits;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commentaire;
use App\Controller\PostController;
use App\Form\CommentaireType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CommentModerationService
{
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function checkCommentAllowed($content)
    {
        // Récupérer les mots interdits depuis la base de données
        $motsInterdits = $this->entityManager->getRepository(MotsInterdits::class)->findAll();
        
        // Vérifier si le contenu du commentaire contient des mots interdits
        foreach ($motsInterdits as $motInterdit) {
            if (strcmp($content, $motInterdit->getMotInterdit()) === 0) {
                return false; // Le commentaire contient un mot interdit
            }
        }
        
        return true; // Le commentaire est autorisé
    }
}
