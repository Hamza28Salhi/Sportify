<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: AbonnementRepository::class)]
class Abonnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("abonnement")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("abonnement")]
    #[Assert\NotBlank(message:"nom is required")]
    #[Assert\Regex(
            pattern:"/^[A-Z]/",
            message:"The first letter of the string must be uppercase")]
    
    
    private ?string $nom = null;


    #[ORM\Column(length: 255)]
    #[Groups("abonnement")]
    #[Assert\NotBlank(message:"description is required")]
    private ?string $description = null;
    

    #[ORM\Column]
    #[Groups("abonnement")]
    #[Assert\NotBlank(message:"prix is required")]
    #[Assert\Positive(message:"Prix doit etre positive")]
    private ?int $prix = null;

    #[ORM\OneToMany(mappedBy: 'abonnement', targetEntity: Categorie::class)]
    #[Groups("abonnement")]
    private Collection $supporteur;

    public function __construct()
    {
        $this->supporteur = new ArrayCollection();
    }

    
  

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */

    /**
     * @return Collection<int, Categorie>
     */
    public function getSupporteur(): Collection
    {
        return $this->supporteur;
    }

    public function addSupporteur(Categorie $supporteur): self
    {
        if (!$this->supporteur->contains($supporteur)) {
            $this->supporteur->add($supporteur);
            $supporteur->setAbonnement($this);
        }

        return $this;
    }

    public function removeSupporteur(Categorie $supporteur): self
    {
        if ($this->supporteur->removeElement($supporteur)) {
            // set the owning side to null (unless already changed)
            if ($supporteur->getAbonnement() === $this) {
                $supporteur->setAbonnement(null);
            }
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->getNom();
    }
    
}
