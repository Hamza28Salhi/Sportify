<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Titre manquant")]
    private ?string $titre_Post = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"Contenu manquant")]
    private ?string $contenu_Post = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_Post = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Auteur manquant")]
    private ?string $auteur_Post = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation_Post = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Commentaire::class, orphanRemoval: true)]
    private Collection $commentaires;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getIdPost(): ?int
    {
        return $this->id;
    }

    
    public function getImagePost(): ?string
    {
        return $this->image_Post;
    }

    public function setImagePost(string $image_Post): self
    {
        $this->image_Post = $image_Post;

        return $this;
    }
    

    public function getTitrePost(): ?string
    {
        return $this->titre_Post;
    }

    public function setTitrePost(string $titre_Post): self
    {
        $this->titre_Post = $titre_Post;

        return $this;
    }

   

    public function getContenuPost(): ?string
    {
        return $this->contenu_Post;
    }

    public function setContenuPost(string $contenu_Post): self
    {
        $this->contenu_Post = $contenu_Post;

        return $this;
    }

    public function getAuteurPost(): ?string
    {
        return $this->auteur_Post;
    }

    public function setAuteurPost(string $auteur_Post): self
    {
        $this->auteur_Post = $auteur_Post;

        return $this;
    }

    public function getDateCreationPost(): ?\DateTimeInterface
    {
        return $this->dateCreation_Post;
    }

    public function setDateCreationPost(\DateTimeInterface $dateCreation_Post): self
    {
        $this->dateCreation_Post = $dateCreation_Post;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setPost($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getPost() === $this) {
                $commentaire->setPost(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getTitrePost();
    }
}
