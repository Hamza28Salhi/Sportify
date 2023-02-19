<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

//use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"contenu commentaire manquant")]
    private ?string $contenu_Commentaire = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"auteur commentaire manquant")]
    private ?string $auteur_Commentaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message:"date de creation manquante")]
    private ?\DateTimeInterface $dateCreation_Commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $post = null;

    public function getIdCommentaire(): ?int
    {
        return $this->id;
    }


    public function getContenuCommentaire(): ?string
    {
        return $this->contenu_Commentaire;
    }

    public function setContenuCommentaire(string $contenu_Commentaire): self
    {
        $this->contenu_Commentaire = $contenu_Commentaire;

        return $this;
    }

    public function getAuteurCommentaire(): ?string
    {
        return $this->auteur_Commentaire;
    }

    public function setAuteurCommentaire(string $auteur_Commentaire): self
    {
        $this->auteur_Commentaire = $auteur_Commentaire;

        return $this;
    }

    public function getDateCreationCommentaire(): ?\DateTimeInterface
    {
        return $this->dateCreation_Commentaire;
    }

    public function setDateCreationCommentaire(\DateTimeInterface $dateCreation_Commentaire): self
    {
        $this->dateCreation_Commentaire = $dateCreation_Commentaire;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function __toString()
    {
        return $this->getContenuCommentaire();
    }
}
