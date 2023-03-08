<?php 
namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserBanService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function banUser(User $user): void
    {
        $user->setIsBanned(true);
        $this->entityManager->flush();
    }

    public function unbanUser(User $user): void
    {
        $user->setIsBanned(false);
        $this->entityManager->flush();
    }
}