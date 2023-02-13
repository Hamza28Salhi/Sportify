<?php

namespace App\Entity;

use App\Repository\MatchesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MatchesRepository::class)]
class Matches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"nom is required")]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"adversaire is required")]

    private ?string $adversaire = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"stade is required")]
    private ?string $stade = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message:"date is required")]

    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"score is required")]

    
    private ?string $score = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"list joueur is required")]

    private ?string $list_joueurs = null;

    #[ORM\ManyToOne]
    private ?Equipe $nom_equipe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdversaire(): ?string
    {
        return $this->adversaire;
    }

    public function setAdversaire(string $adversaire): self
    {
        $this->adversaire = $adversaire;

        return $this;
    }

    public function getStade(): ?string
    {
        return $this->stade;
    }

    public function setStade(string $stade): self
    {
        $this->stade = $stade;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getListJoueurs(): ?string
    {
        return $this->list_joueurs;
    }

    public function setListJoueurs(string $list_joueurs): self
    {
        $this->list_joueurs = $list_joueurs;

        return $this;
    }

    public function getNomEquipe(): ?Equipe
    {
        return $this->nom_equipe;
    }

    public function setNomEquipe(?Equipe $nom_equipe): self
    {
        $this->nom_equipe = $nom_equipe;

        return $this;
    }
    public function __toString()
{
    return $this->nom_equipe;
}

   
}
