<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoteRepository::class)]
class Vote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'votes')]
    public ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'votes')]
    public ?Post $post_id = null;

    #[ORM\Column(length: 255)]
    public ?string $type_vote = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPostId(): ?Post
    {
        return $this->post_id;
    }

    public function setPostId(?Post $post_id): self
    {
        $this->post_id = $post_id;

        return $this;
    }

    public function getTypeVote(): ?string
    {
        return $this->type_vote;
    }

    public function setTypeVote(string $type_vote): self
    {
        $this->type_vote = $type_vote;

        return $this;
    }
}
