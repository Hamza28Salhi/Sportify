<?php
namespace App\Utils;
namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;





use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;


#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("equipes")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("equipes")]
    #[Assert\NotBlank(message:"nom is required")]
    #[Assert\Regex(
        pattern:"/^[A-Z]/",
         message:"The first letter of the string must be uppercase"
    )]
   
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups("equipes")]
    #[Assert\NotBlank(message:"joueur is required")]
    private ?string $joueurs = null;

    #[ORM\Column]
    #[Groups("equipes")]
    #[Assert\NotBlank(message:"classement is required")]
    #[Assert\GreaterThanOrEqual(
        value:0,
         message:"The value of classement must not be negative"
    )]
    private ?int $classement = null;

    #[ORM\Column(length: 255)]
    #[Groups("equipes")]
    #[Assert\NotBlank(message:"entraineur is required")]
    private ?string $entraineur = null;

    #[ORM\Column(length: 255)]
    #[Groups("equipes")]
    #[Assert\NotBlank(message:"categorie is required")]
    private ?string $categorie = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups("equipes")]
   
    private ?string $picture = null;

    #[ORM\OneToMany(targetEntity: Matches::class, mappedBy: 'nom_equipe')]
    #[Groups("equipes")]
    #[MaxDepth(1)]
    
    private Collection $matches;

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

    public function __construct()
    {
        $this->matches = new ArrayCollection();
    }
    
    public function getMatches(): Collection
    {
        return $this->matches;
    }

    public function addMatch(Matches $match): self
    {
        if (!$this->matches->contains($match)) {
            $this->matches[] = $match;
            $match->setNomEquipe($this);
        }

        return $this;
    }

    public function removeMatch(Matches $match): self
    {
        if ($this->matches->contains($match)) {
            $this->matches->removeElement($match);
            // set the owning side to null (unless already changed)
            if ($match->getNomEquipe() === $this) {
                $match->setNomEquipe(null);
            }
        }

        return $this;
    }

    

}
