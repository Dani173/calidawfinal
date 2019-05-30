<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LevelRepository")
 */
class Level
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="level")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Routine", mappedBy="level")
     */
    private $routine;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->routine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): ?Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setLevel($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getLevel() === $this) {
                $user->setLevel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Routine[]
     */
    public function getRoutine(): Collection
    {
        return $this->routine;
    }

    public function addRoutine(Routine $routine): self
    {
        if (!$this->routine->contains($routine)) {
            $this->routine[] = $routine;
            $routine->setLevel($this);
        }

        return $this;
    }

    public function removeRoutine(Routine $routine): self
    {
        if ($this->routine->contains($routine)) {
            $this->routine->removeElement($routine);
            // set the owning side to null (unless already changed)
            if ($routine->getLevel() === $this) {
                $routine->setLevel(null);
            }
        }

        return $this;
    }
}
