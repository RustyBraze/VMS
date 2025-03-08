<?php

namespace App\Entity;

use App\Enum\ShiftStatusEnum;
use App\Repository\ShiftApplicationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ShiftApplicationRepository::class)]
class ShiftApplication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $uuid = null;

    #[ORM\ManyToOne(inversedBy: 'shiftApplications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'shiftApplications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?shift $shift_id = null;

    #[ORM\Column(enumType: ShiftStatusEnum::class)]
    private ?ShiftStatusEnum $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $applied_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function setUuid(Uuid $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getShiftId(): ?shift
    {
        return $this->shift_id;
    }

    public function setShiftId(?shift $shift_id): static
    {
        $this->shift_id = $shift_id;

        return $this;
    }

    public function getStatus(): ?ShiftStatusEnum
    {
        return $this->status;
    }

    public function setStatus(ShiftStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAppliedAt(): ?\DateTimeInterface
    {
        return $this->applied_at;
    }

    public function setAppliedAt(\DateTimeInterface $applied_at): static
    {
        $this->applied_at = $applied_at;

        return $this;
    }
}
