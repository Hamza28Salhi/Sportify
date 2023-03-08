<?php 
// src/Service/UserStatisticsService.php

namespace App\Service;

use App\Repository\UserRepository;

class UserStatisticsService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getRoleCounts(): array
    {
        return $this->userRepository->countRoles();
    }
}