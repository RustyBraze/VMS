<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, unique: true)]
    private ?string $username = null;

    #[ORM\Column(length: 100)]
    private ?string $first_name = null;

    #[ORM\Column(length: 100)]
    private ?string $last_name = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password_hash = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $telegram_handle = null;

    #[ORM\Column(nullable: true)]
    private ?int $telegram_id = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(nullable: true)]
    private ?array $privacy_permissions = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $user_uuid = null;

    /**
     * @var Collection<int, ShiftApplication>
     */
    #[ORM\OneToMany(targetEntity: ShiftApplication::class, mappedBy: 'user_id')]
    private Collection $shiftApplications;

    /**
     * @var Collection<int, CheckInOut>
     */
    #[ORM\OneToMany(targetEntity: CheckInOut::class, mappedBy: 'user_id')]
    private Collection $checkInOuts;

    public function __construct()
    {
        $this->shiftApplications = new ArrayCollection();
        $this->checkInOuts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPasswordHash(): ?string
    {
        return $this->password_hash;
    }

    public function setPasswordHash(string $password_hash): static
    {
        $this->password_hash = $password_hash;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getTelegramHandle(): ?string
    {
        return $this->telegram_handle;
    }

    public function setTelegramHandle(?string $telegram_handle): static
    {
        $this->telegram_handle = $telegram_handle;

        return $this;
    }

    public function getTelegramId(): ?int
    {
        return $this->telegram_id;
    }

    public function setTelegramId(?int $telegram_id): static
    {
        $this->telegram_id = $telegram_id;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPrivacyPermissions(): ?array
    {
        return $this->privacy_permissions;
    }

    public function setPrivacyPermissions(?array $privacy_permissions): static
    {
        $this->privacy_permissions = $privacy_permissions;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): static
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getUserUuid(): ?Uuid
    {
        return $this->user_uuid;
    }

    public function setUserUuid(Uuid $user_uuid): static
    {
        $this->user_uuid = $user_uuid;

        return $this;
    }

    /**
     * @return Collection<int, ShiftApplication>
     */
    public function getShiftApplications(): Collection
    {
        return $this->shiftApplications;
    }

    public function addShiftApplication(ShiftApplication $shiftApplication): static
    {
        if (!$this->shiftApplications->contains($shiftApplication)) {
            $this->shiftApplications->add($shiftApplication);
            $shiftApplication->setUserId($this);
        }

        return $this;
    }

    public function removeShiftApplication(ShiftApplication $shiftApplication): static
    {
        if ($this->shiftApplications->removeElement($shiftApplication)) {
            // set the owning side to null (unless already changed)
            if ($shiftApplication->getUserId() === $this) {
                $shiftApplication->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CheckInOut>
     */
    public function getCheckInOuts(): Collection
    {
        return $this->checkInOuts;
    }

    public function addCheckInOut(CheckInOut $checkInOut): static
    {
        if (!$this->checkInOuts->contains($checkInOut)) {
            $this->checkInOuts->add($checkInOut);
            $checkInOut->setUserId($this);
        }

        return $this;
    }

    public function removeCheckInOut(CheckInOut $checkInOut): static
    {
        if ($this->checkInOuts->removeElement($checkInOut)) {
            // set the owning side to null (unless already changed)
            if ($checkInOut->getUserId() === $this) {
                $checkInOut->setUserId(null);
            }
        }

        return $this;
    }
}
