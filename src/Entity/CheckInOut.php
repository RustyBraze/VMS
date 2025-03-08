<?php

namespace App\Entity;

use App\Repository\CheckInOutRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CheckInOutRepository::class)]
class CheckInOut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $uuid = null;

    #[ORM\ManyToOne(inversedBy: 'checkInOuts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'checkInOuts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?shift $shift_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $check_in_time = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $check_out_time = null;

    public function __construct()
    {
        $this->check_in_time = new \DateTime();
//        $this->check_out_time = new \DateTime();
    }

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

    public function getCheckInTime(): ?\DateTimeInterface
    {
        return $this->check_in_time;
    }

    public function setCheckInTime(\DateTimeInterface $check_in_time): static
    {
        $this->check_in_time = $check_in_time;

        return $this;
    }

    public function getCheckOutTime(): ?\DateTimeInterface
    {
        return $this->check_out_time;
    }

    public function setCheckOutTime(\DateTimeInterface $check_out_time): static
    {
        $this->check_out_time = $check_out_time;

        return $this;
    }
}
