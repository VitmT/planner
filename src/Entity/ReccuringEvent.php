<?php
namespace App\Entity;use App\Repository\ReccuringEventRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;#[ORM\Entity(repositoryClass: ReccuringEventRepository::class)]
class ReccuringEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;    #[ORM\Column(length: 255)]
    private ?string $name = null;    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $defaultTimestamp = null;    #[ORM\Column(length: 255)]
    private ?string $reccurenceType = null;    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $eventDate = null; // Added eventDate property    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'events')]
    private Collection $users;    #[ORM\OneToMany(mappedBy: 'reccuringEvent', targetEntity: ReccuringEventOccurence::class)]
    private Collection $reccuringEventOccurences;    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->reccuringEventOccurences = new ArrayCollection();
    }    public function getId(): ?int
    {
        return $this->id;
    }    public function getName(): ?string
    {
        return $this->name;
    }    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }    public function getDefaultTimestamp(): ?\DateTimeInterface
    {
        return $this->defaultTimestamp;
    }    public function setDefaultTimestamp(\DateTimeInterface $defaultTimestamp): self
    {
        $this->defaultTimestamp = $defaultTimestamp;
        return $this;
    }    public function getReccurenceType(): ?string
    {
        return $this->reccurenceType;
    }    public function setReccurenceType(string $reccurenceType): self
    {
        $this->reccurenceType = $reccurenceType;
        return $this;
    }    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->eventDate;
    }    public function setEventDate(\DateTimeInterface $eventDate): self
    {
        $this->eventDate = $eventDate;
        return $this;
    }    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addEvent($this);
        }        return $this;
    }    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeEvent($this);
        }        return $this;
    }    /**
     * @return Collection<int, ReccuringEventOccurence>
     */
    public function getReccuringEventOccurences(): Collection
    {
        return $this->reccuringEventOccurences;
    }    public function addReccuringEventOccurence(ReccuringEventOccurence $reccuringEventOccurence): self
    {
        if (!$this->reccuringEventOccurences->contains($reccuringEventOccurence)) {
            $this->reccuringEventOccurences->add($reccuringEventOccurence);
            $reccuringEventOccurence->setReccuringEvent($this);
        }        return $this;
    }    public function removeReccuringEventOccurence(ReccuringEventOccurence $reccuringEventOccurence): self
    {
        if ($this->reccuringEventOccurences->removeElement($reccuringEventOccurence)) {
            // set the owning side to null (unless already changed)
            if ($reccuringEventOccurence->getReccuringEvent() === $this) {
                $reccuringEventOccurence->setReccuringEvent(null);
            }
        }        return $this;
    }
}
