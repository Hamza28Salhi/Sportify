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

    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"le nom is required")]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"le prénom is required")]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"l'adresse mail is required")]
    #[Assert\Email(message:"l'adresse mail est non valide")]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"le numéro de téléphone is required")]
    #[Assert\Positive(message:"le numéro de téléphone doit etre positive")]
    /*#[Assert\Regex(
        pattern:"[0-9]{1,8}$",
         message:"Le numéro de téléphone doit être composé de 1 à 8 chiffres"
     )]*/
   
   
    //#[Assert\Length(min =8,max=8,exactMessage = "Le numéro de téléphone doit être composé de 8 chiffres")]
    //#[ORM\Column(type="string", length=8, nullable=true)]
    //private $telephone;
    private ?string $telephone = null;    

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"paiement is required")]
    private ?string $paiement = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Evenement $evenement = null;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom=null): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse=null): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone=null): self
    {
        $this->telephone = $telephone;

        return $this;
    }


    public function getPaiement(): ?string
    {
        return $this->paiement;
    }

    public function setPaiement(string $paiement=null): self
    {
        $this->paiement = $paiement;

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
