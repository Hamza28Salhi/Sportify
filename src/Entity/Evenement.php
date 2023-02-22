<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"date is required")]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"type is required")]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"lieu is required")]
    private ?string $lieu = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"description is required")]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: Reservation::class)]
    private Collection $Reservations;

    #[ORM\Column(length: 255,nullable:true)]
    public ?string $even_pic = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"titre is required")]
    private ?string $titre = null;

    public function __construct()
    {
        $this->Reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type=null): self
    {
        $this->type = $type;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu=null): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description=null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->Reservations;
    }

    public function addReservation(Reservation $Reservation): self
    {
        if (!$this->Reservations->contains($Reservation)) {
            $this->Reservations->add($Reservation);
            $Reservation->setEvenement($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $Reservation): self
    {
        if ($this->Reservations->removeElement($Reservation)) {
            // set the owning side to null (unless already changed)
            if ($Reservation->getEvenement() === $this) {
                $Reservation->setEvenement(null);
            }
        }

        return $this;
    }

    public function getEvenPic(): ?string
    {
        return $this->even_pic;
    }

    public function setEvenPic(string $even_pic=null): self
    {
        $this->even_pic = $even_pic;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }
}
