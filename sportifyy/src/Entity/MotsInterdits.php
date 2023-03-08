<?php

namespace App\Entity;

use App\Repository\MotsInterditsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotsInterditsRepository::class)]
class MotsInterdits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $motInterdit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotInterdit(): ?string
    {
        return $this->motInterdit;
    }

    public function setMotInterdit(?string $motInterdit): self
    {
        $this->motInterdit = $motInterdit;

        return $this;
    }
}
