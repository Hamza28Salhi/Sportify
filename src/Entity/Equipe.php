<?php
namespace App\Utils;
namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;


#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"nom is required")]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message:"joueur is required")]
    private ?string $joueurs = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"classement is required")]
    private ?int $classement = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"entraineur is required")]
    private ?string $entraineur = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"categorie is required")]
    private ?string $categorie = null;

    #[ORM\Column(length: 255, nullable: true)]
   
    private ?string $picture = null;

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

    public function getJoueurs(): ?string
    {
        return $this->joueurs;
    }

    public function setJoueurs(?string $joueurs=null): self
    {
        $this->joueurs = $joueurs;

        return $this;
    }

    public function getClassement(): ?int
    {
        return $this->classement;
    }

    public function setClassement(int $classement=null): self
    {
        $this->classement = $classement;

        return $this;
    }

    public function getEntraineur(): ?string
    {
        return $this->entraineur;
    }

    public function setEntraineur(string $entraineur=null): self
    {
        $this->entraineur = $entraineur;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie=null): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture=null): self
    {
        $this->picture = $picture;

        return $this;
    }
    

    

}
