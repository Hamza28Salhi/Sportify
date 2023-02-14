<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"ID is required")]
    private ?int $id_reservation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"date reservation is required")]
    private ?\DateTimeInterface $date_reservation = null;
     

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"heured is required")]
    private ?string $heureD = null;
    

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"heuref is required")]
    private ?string $heureF = null;
    

    #[ORM\Column(length: 255)]
    private ?string $typeSport = null;
    #[Assert\NotBlank(message:"typeSport is required")]

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"coût is required")]
    private ?string $cout = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Evenement $evenement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReservation(): ?int
    {
        return $this->id_reservation;
    }

    public function setIdReservation(int $id_reservation): self
    {
        $this->id_reservation = $id_reservation;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->date_reservation;
    }

    public function setDateReservation(\DateTimeInterface $date_reservation): self
    {
        $this->date_reservation = $date_reservation;

        return $this;
    }

    public function getHeureD(): ?string
    {
        return $this->heureD;
    }

    public function setHeureD(string $heureD): self
    {
        $this->heureD = $heureD;

        return $this;
    }

    public function getHeureF(): ?string
    {
        return $this->heureF;
    }

    public function setHeureF(string $heureF): self
    {
        $this->heureF = $heureF;

        return $this;
    }

    public function getTypeSport(): ?string
    {
        return $this->typeSport;
    }

    public function setTypeSport(string $typeSport): self
    {
        $this->typeSport = $typeSport;

        return $this;
    }

    public function getCout(): ?string
    {
        return $this->cout;
    }

    public function setCout(string $cout): self
    {
        $this->cout = $cout;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }
}
