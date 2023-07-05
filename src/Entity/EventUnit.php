<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class EventUnit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: "eventUnit")]
    private Event $event;

    #[ORM\ManyToOne(targetEntity: Unit::class, inversedBy: "eventUnits")]
    private Unit $unit;

    #[ORM\Column]
    private bool $reassign;

    #[ORM\OneToOne(inversedBy: "eventUnit", targetEntity: Event::class)]
    private Event $reassignFrom;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function setEvent(Event $event): self
    {
        $this->event = $event;
        return $this;
    }

    public function getUnit(): Unit
    {
        return $this->unit;
    }

    public function setUnit(Unit $unit): self
    {
        $this->unit = $unit;
        return $this;
    }

    public function isReassign(): bool
    {
        return $this->reassign;
    }

    public function setReassign(bool $reassign): self
    {
        $this->reassign = $reassign;
        return $this;
    }

    public function getReassignFrom(): Event
    {
        return $this->reassignFrom;
    }

    public function setReassignFrom(Event $reassignFrom): self
    {
        $this->reassignFrom = $reassignFrom;
        return $this;
    }
}