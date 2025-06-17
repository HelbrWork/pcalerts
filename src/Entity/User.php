<?php declare(strict_types=1);

namespace App\Entity;

use App\Enum\Roles;
use App\Enum\UserType;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int|null $id = null;

    #[ORM\Column(type: Types::STRING, length: 100, unique: true, nullable: true)]
    private string|null $email;

    #[ORM\Column(type: Types::STRING, length: 50, unique: true, nullable: true)]
    private string|null $tgName;

    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    private string|null $firstName;

    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    private string|null $lastName;

    #[ORM\Column(type: Types::STRING, nullable: true, enumType: UserType::class)]
    private UserType|null $type;

    #[ORM\Column(type: Types::STRING, length: 50, unique: true, nullable: true)]
    private string|null $affiseUserID;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $active = false;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private array|null $roles;

    #[ORM\Column(type: Types::STRING)]
    private string $password;

    #[ORM\OneToMany()]
    private Collection $advertisers;

    private ?string $plainPassword = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): User
    {
        $this->id = $id;

        return $this;
    }


    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): User
    {
        $this->active = $active;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = Roles::ROLE_USER->value;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): User
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): User
    {
        $this->email = $email;

        return $this;
    }

    public function getTgName(): ?string
    {
        return $this->tgName;
    }

    public function setTgName(?string $tgName): User
    {
        $this->tgName = $tgName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): User
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): User
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getType(): ?UserType
    {
        return $this->type;
    }

    public function setType(?UserType $type): User
    {
        $this->type = $type;

        return $this;
    }

    public function getAffiseUserID(): ?string
    {
        return $this->affiseUserID;
    }

    public function setAffiseUserID(?string $affiseUserID): User
    {
        $this->affiseUserID = $affiseUserID;

        return $this;
    }

}