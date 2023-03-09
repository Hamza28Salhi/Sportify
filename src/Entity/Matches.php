<?php

namespace App\Entity;

use App\Repository\MatchesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;




#[ORM\Entity(repositoryClass: MatchesRepository::class)]
class Matches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("matches")]

    private ?int $id = null;

    #[ORM\Column(length: 255, )]
    #[Groups("matches")]

    #[Assert\NotBlank(message:"nom is required")]
    #[Assert\Regex(
            pattern:"/^[A-Z]/",
             message:"The first letter of the string must be uppercase"
        )]
    private ?string $nom = null;

    

    #[ORM\Column(length: 255,)]
    #[Groups("matches")]

    #[Assert\NotBlank(message:"stade is required")]
    private ?string $stade = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,)]
    #[Assert\NotBlank(message:"date is required")]
    #[Groups("matches")]

    

    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type:"string", length:255, nullable:true)]
    #[Groups("matches")]

    
    
    private ?string $score = null;

    
    #[ORM\ManyToOne]

    #[Assert\NotBlank(message:"adversaire is required")]
    #[Groups("matches")]
    #[MaxDepth(1)]

    private ?Equipe $nom_equipe = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups("matches")]

    private ?string $video = null;

    #[ORM\Column(nullable: true)]
    #[Groups("matches")]

    private ?float $latitude = null;

    #[ORM\Column(nullable: true)]
    #[Groups("matches")]

    private ?float $longitude = null;
 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom=null): self
    {
        $this->nom = $nom;

        return $this;
    }


    public function getStade(): ?string
    {
        return $this->stade;
    }

    public function setStade(string $stade=null): self
    {
        $this->stade = $stade;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date=null): self
    {
        $this->date = $date;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score=null): self
    {
        $this->score = $score;

        return $this;
    }


    public function getNomEquipe(): ?Equipe
    {
        return $this->nom_equipe;
    }

    public function setNomEquipe(?Equipe $nom_equipe=null): self
    {
        $this->nom_equipe = $nom_equipe;

        return $this;
    }
   
    public function __toString()
    {
         $this->nom_equipe;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }


   
}
