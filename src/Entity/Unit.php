<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\UnitType;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ApiResource]
class Unit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private string $name;

    #[ORM\Column]
    private string $unitType;

    #[ORM\OneToMany(mappedBy: 'unit', targetEntity: EventUnit::class)]
    private $eventUnits;

    public function __construct()
    {
        $this->eventUnits = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getUnitType(): string
    {
        return $this->unitType;
    }

    public function setUnitType(string $unitType): self
    {
        if (!in_array($unitType, [UnitType::CRS, UnitType::EGM])) {
            throw new \InvalidArgumentException('Invalid unit');
        }
        $this->unitType = $unitType;
        return $this;
    }

    public function getEventUnits()
    {
        return $this->eventUnits;
    }

    public function setEventUnits($eventUnits): self
    {
        $this->eventUnits = $eventUnits;
        return $this;
    }
}
