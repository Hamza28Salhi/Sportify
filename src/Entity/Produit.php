<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"ID is required")]
    private ?int $id_produit = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"nomproduit is required")]
    private ?string $nom_produit = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Prix is required")]
    private ?float $prix_produit = null;

    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"marque is required")]
    private ?string $marque_produit = null;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    private ?Categorie $categorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduit(): ?int
    {
        return $this->id_produit;
    }

    public function setIdProduit(int $id_produit): self
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    public function getNomProduit(): ?string
    {
        return $this->nom_produit;
    }

    public function setNomProduit(string $nom_produit): self
    {
        $this->nom_produit = $nom_produit;

        return $this;
    }

    public function getPrixProduit(): ?float
    {
        return $this->prix_produit;
    }

    public function setPrixProduit(float $prix_produit): self
    {
        $this->prix_produit = $prix_produit;

        return $this;
    }

    
    public function getMarqueProduit(): ?string
    {
        return $this->marque_produit;
    }

    public function setMarqueProduit(string $marque_produit): self
    {
        $this->marque_produit = $marque_produit;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
