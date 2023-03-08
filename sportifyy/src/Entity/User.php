<?php

namespace App\Entity;

use App\Repository\UserRepository;
<<<<<<< HEAD
=======
use Doctrine\DBAL\Types\Types;
>>>>>>> origin/GestionUser
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
<<<<<<< HEAD
=======
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
>>>>>>> origin/GestionUser

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
<<<<<<< HEAD
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email(message:"the email '{{ value }}' is required")]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];
=======
    #[Groups("user")]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true, nullable: true)]
    #[Groups("user")]
    #[Assert\Email(message:"'{{ value }}' is not a valid Email")]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups("user")]
    public array $roles = [];
>>>>>>> origin/GestionUser

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
<<<<<<< HEAD
    private ?string $password = null;

=======
    #[Groups("user")]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups("user")]
    #[Assert\NotBlank]
    public ?string $full_name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups("user")]
    public ?\DateTimeInterface $date_naiss = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups("user")]
    public ?string $user_pic = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups("user")]
    public ?string $matr_fisc = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups("user")]
    public ?string $prod_category = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups("user")]
    public ?string $job_position = null;

    /**
     * @var bool
     */
    public $show_second_form;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups("user")]
    public ?string $Address = null;


    
    /**
     * @ORM\Column(type="boolean")
     */
    private $confirmed = false;

    public function isConfirmed(): bool
    {
        return $this->confirmed;
    }

    public function setConfirmed(bool $confirmed): self
    {
        $this->confirmed = $confirmed;

        return $this;
    }

>>>>>>> origin/GestionUser
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

<<<<<<< HEAD
    public function setEmail(string $email): self
=======
    public function setEmail(string $email=null): self
>>>>>>> origin/GestionUser
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
<<<<<<< HEAD
=======

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name=null): self
    {
        $this->full_name = $full_name;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->date_naiss;
    }

    public function setDateNaiss(\DateTimeInterface $date_naiss=null ): self
    {
        $this->date_naiss = $date_naiss;

        return $this;
    }

    public function getUserPic(): ?string
    {
        return $this->user_pic;
    }

    public function setUserPic(string $user_pic=null): self
    {
        $this->user_pic = $user_pic;

        return $this;
    }

    public function getMatrFisc(): ?string
    {
        return $this->matr_fisc;
    }

    public function setMatrFisc(string $matr_fisc=null): self
    {
        $this->matr_fisc = $matr_fisc;

        return $this;
    }

    public function getProdCategory(): ?string
    {
        return $this->prod_category;
    }

    public function setProdCategory(string $prod_category=null): self
    {
        $this->prod_category = $prod_category;

        return $this;
    }

    public function getJobPosition(): ?string
    {
        return $this->job_position;
    }

    public function setJobPosition(string $job_position=null): self
    {
        $this->job_position = $job_position;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address=null): self
    {
        $this->Address = $Address;

        return $this;
    }


    

>>>>>>> origin/GestionUser
}
