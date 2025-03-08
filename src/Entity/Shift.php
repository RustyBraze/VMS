<?php

namespace App\Entity;

use App\Repository\ShiftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ShiftRepository::class)]
class Shift
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $uuid = null;

    #[ORM\ManyToOne(inversedBy: 'shifts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ShiftType $shift_type = null;

    #[ORM\ManyToOne(inversedBy: 'shifts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start_time = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end_time = null;

    #[ORM\Column]
    private ?int $max_participants = null;

    #[ORM\Column]
    private ?bool $is_night_shift = null;

    /**
     * @var Collection<int, ShiftApplication>
     */
    #[ORM\OneToMany(targetEntity: ShiftApplication::class, mappedBy: 'shift_id')]
    private Collection $shiftApplications;

    /**
     * @var Collection<int, CheckInOut>
     */
    #[ORM\OneToMany(targetEntity: CheckInOut::class, mappedBy: 'shift_id')]
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

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function setUuid(Uuid $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getShiftType(): ?ShiftType
    {
        return $this->shift_type;
    }

    public function setShiftType(?ShiftType $shift_type): static
    {
        $this->shift_type = $shift_type;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->start_time;
    }

    public function setStartTime(\DateTimeInterface $start_time): static
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->end_time;
    }

    public function setEndTime(\DateTimeInterface $end_time): static
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function getMaxParticipants(): ?int
    {
        return $this->max_participants;
    }

    public function setMaxParticipants(int $max_participants): static
    {
        $this->max_participants = $max_participants;

        return $this;
    }

    public function isNightShift(): ?bool
    {
        return $this->is_night_shift;
    }

    public function setIsNightShift(bool $is_night_shift): static
    {
        $this->is_night_shift = $is_night_shift;

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
            $shiftApplication->setShiftId($this);
        }

        return $this;
    }

    public function removeShiftApplication(ShiftApplication $shiftApplication): static
    {
        if ($this->shiftApplications->removeElement($shiftApplication)) {
            // set the owning side to null (unless already changed)
            if ($shiftApplication->getShiftId() === $this) {
                $shiftApplication->setShiftId(null);
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
            $checkInOut->setShiftId($this);
        }

        return $this;
    }

    public function removeCheckInOut(CheckInOut $checkInOut): static
    {
        if ($this->checkInOuts->removeElement($checkInOut)) {
            // set the owning side to null (unless already changed)
            if ($checkInOut->getShiftId() === $this) {
                $checkInOut->setShiftId(null);
            }
        }

        return $this;
    }
}
