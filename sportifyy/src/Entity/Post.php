<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
/*use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Votable\Traits\VotableEntity;*/


#[ORM\Entity(repositoryClass: PostRepository::class)]
//#[Gedmo\Timestampable(repositoryClass: PostRepository::class)]
//#[Gedmo\Votable(repositoryClass: PostRepository::class)]
class Post
{

    //use TimestampableEntity;
    //use VotableEntity;

    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("posts")]
    //private ?int $id = null; 
    public ?int $id = null; //public car probleme dans PostMobileController


    #[ORM\Column(length: 255)]
    #[Groups("posts")]
    #[Assert\NotBlank(message:"Titre manquant")]
    #[Assert\Regex(
        pattern: "/^[a-zA-Z\s\p{P}]+$/u",
        message: "Le titre ne doit contenir que des lettres"
    )]
    private ?string $titre_Post = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups("posts")]
    #[Assert\NotBlank(message:"Contenu manquant")]
    #[Assert\Length(min: 30, minMessage: "Le post doit comporter au moins 30 caractères")]
    #[Assert\Regex(
        pattern: '/(?:\n.*){2}/', 
        message: "Le post doit contenir au moins trois retours à la ligne."
    )]
    private ?string $contenu_Post = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups("posts")]
    private ?string $image_Post = null;

    #[ORM\Column(length: 255)]
    #[Groups("posts")]
    #[Assert\NotBlank(message:"Auteur manquant")]
    #[Assert\Regex( 
        pattern: "/^[a-zA-Z\s\p{P}]+$/u",
        message: "L'auteur ne doit contenir que des lettres"
    )]
    private ?string $auteur_Post = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation_Post = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Commentaire::class, orphanRemoval: true)]
    private Collection $commentaires;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Likes = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Dislike = null;

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

    public function setTitrePost(string $titre_Post): self //    public function setTitrePost(string $titre_Post=null): self
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

    public function getLikes(): ?string
    {
        return $this->Likes;
    }

    public function setLikes(string $Likes): self
    {
        $this->Likes = $Likes;

        return $this;
    }

    public function getDislike(): ?string
    {
        return $this->Dislike;
    }

    public function setDislike(string $Dislike): self
    {
        $this->Dislike = $Dislike;

        return $this;
    }
}