<?php

namespace App\Entity;

use App\Repository\ReccuringEventOccurenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReccuringEventOccurenceRepository::class)]
class ReccuringEventOccurence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $timestamp;

    #[ORM\Column]
    private int $duration;

    #[ORM\ManyToOne(inversedBy: 'reccuringEventOccurences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ReccuringEvent $reccuringEvent = null;

    #[ORM\Column(length: 255)]
    private ?string $note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getReccuringEvent(): ?ReccuringEvent
    {
        return $this->reccuringEvent;
    }

    public function setReccuringEvent(?ReccuringEvent $reccuringEvent): self
    {
        $this->reccuringEvent = $reccuringEvent;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }
}
