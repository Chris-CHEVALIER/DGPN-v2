<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Enum\EventType;
use App\Enum\MissionType;
use App\Enum\TicketStatut;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: "string")]
    private string $status;

    #[ORM\Column(type: "datetime")]
    private \DateTime $createdAt;

    #[ORM\Column(type: "datetime")]
    private \DateTime $lastUpdate;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description;

    #[ORM\Column(length: 8)]
    private int $postalCode;

    #[ORM\Column(length: 128)]
    private string $city;

    #[ORM\Column(length: 64)]
    private string $department;

    #[ORM\Column(length: 64)]
    private string $missionType;

    #[ORM\Column]
    private int $unitRequested;

    #[ORM\OneToOne(inversedBy: 'ticket', targetEntity: Event::class)]
    private Event $event;

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function setEvent(Event $event): self
    {
        $this->event = $event;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        if (!in_array($status, [TicketStatut::AFFECTE, TicketStatut::REAFFECTE, TicketStatut::ATTENTE])) {
            throw new \InvalidArgumentException('Invalid status');
        }
        $this->status = $status;
        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    
    /**
     * Get the value of last_update
     */ 
    public function getLastUpdate(): \DateTime
    {
        return $this->lastUpdate;
    }

    /**
     * Set the value of last_update
     *
     * @return  self
     */ 
    public function setLastUpdate(\DateTime $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function getDescription(): string
    {
        if ($this->description !== null) {
            return $this->description;
        }
        return "";
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPostalCode(): int
    {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity($city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function setDepartment(string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getMissionType(): string
    {
        return $this->missionType;
    }

    public function setMissionType($missionType): self
    {
        $this->missionType = $missionType;
        return $this;
    }

    public function getUnitRequested(): int
    {
        return $this->unitRequested;
    }

    public function setUnitRequested($unitRequested): self
    {
        $this->unitRequested = $unitRequested;
        return $this;
    }

}
