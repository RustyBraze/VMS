<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
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

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $map_embed_code = null;

    #[ORM\Column(nullable: true)]
    private ?array $contact_people = null;

    /**
     * @var Collection<int, Shift>
     */
    #[ORM\OneToMany(targetEntity: Shift::class, mappedBy: 'location')]
    private Collection $shifts;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
        $this->shifts = new ArrayCollection();
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

    public function getMapEmbedCode(): ?string
    {
        return $this->map_embed_code;
    }

    public function setMapEmbedCode(?string $map_embed_code): static
    {
        $this->map_embed_code = $map_embed_code;

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
     * @return Collection<int, Shift>
     */
    public function getShifts(): Collection
    {
        return $this->shifts;
    }

    public function addShift(Shift $shift): static
    {
        if (!$this->shifts->contains($shift)) {
            $this->shifts->add($shift);
            $shift->setLocation($this);
        }

        return $this;
    }

    public function removeShift(Shift $shift): static
    {
        if ($this->shifts->removeElement($shift)) {
            // set the owning side to null (unless already changed)
            if ($shift->getLocation() === $this) {
                $shift->setLocation(null);
            }
        }

        return $this;
    }
}
