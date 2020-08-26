<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ScmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ScmRepository::class)
 */
class Scm
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
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $siret;

    /**
     * @ORM\Column(type="float")
     */
    private $capital;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="scms")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Charges::class, mappedBy="scm", orphanRemoval=true)
     */
    private $charges;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->charges = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(int $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getCapital(): ?float
    {
        return $this->capital;
    }

    public function setCapital(float $capital): self
    {
        $this->capital = $capital;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }

    /**
     * @return Collection|Charges[]
     */
    public function getCharges(): Collection
    {
        return $this->charges;
    }

    public function addCharge(Charges $charge): self
    {
        if (!$this->charges->contains($charge)) {
            $this->charges[] = $charge;
            $charge->setScm($this);
        }

        return $this;
    }

    public function removeCharge(Charges $charge): self
    {
        if ($this->charges->contains($charge)) {
            $this->charges->removeElement($charge);
            // set the owning side to null (unless already changed)
            if ($charge->getScm() === $this) {
                $charge->setScm(null);
            }
        }

        return $this;
    }
}
