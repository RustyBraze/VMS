<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $uuid = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $is_internal = null;

    #[ORM\Column(nullable: true)]
    private ?array $contact_people = null;

    /**
     * @var Collection<int, ShiftType>
     */
    #[ORM\OneToMany(targetEntity: ShiftType::class, mappedBy: 'department')]
    private Collection $shiftTypes;

    public function __construct()
    {
        $this->shiftTypes = new ArrayCollection();
        $this->uuid = Uuid::v4();
        $this->is_internal = false;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isInternal(): ?bool
    {
        return $this->is_internal;
    }

    public function setIsInternal(bool $is_internal): static
    {
        $this->is_internal = $is_internal;

        return $this;
    }

    public function getContactPeople(): ?array
    {
        return $this->contact_people;
    }

    public function setContactPeople(?array $contact_people): static
    {
        $this->contact_people = $contact_people;

        return $this;
    }

    /**
     * @return Collection<int, ShiftType>
     */
    public function getShiftTypes(): Collection
    {
        return $this->shiftTypes;
    }

    public function addShiftType(ShiftType $shiftType): static
    {
        if (!$this->shiftTypes->contains($shiftType)) {
            $this->shiftTypes->add($shiftType);
            $shiftType->setDepartment($this);
        }

        return $this;
    }

    public function removeShiftType(ShiftType $shiftType): static
    {
        if ($this->shiftTypes->removeElement($shiftType)) {
            // set the owning side to null (unless already changed)
            if ($shiftType->getDepartment() === $this) {
                $shiftType->setDepartment(null);
            }
        }

        return $this;
    }
}
