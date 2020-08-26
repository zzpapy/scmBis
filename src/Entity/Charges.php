<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ChargesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ChargesRepository::class)
 */
class Charges
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $paymentAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $payedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Scm::class, inversedBy="charges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $scm;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setType(?bool $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPaymentAt(): ?\DateTimeInterface
    {
        return $this->paymentAt;
    }

    public function setPaymentAt(\DateTimeInterface $paymentAt): self
    {
        $this->paymentAt = $paymentAt;

        return $this;
    }

    public function getPayedAt(): ?\DateTimeInterface
    {
        return $this->payedAt;
    }

    public function setPayedAt(?\DateTimeInterface $payedAt): self
    {
        $this->payedAt = $payedAt;

        return $this;
    }

    public function getScm(): ?Scm
    {
        return $this->scm;
    }

    public function setScm(?Scm $scm): self
    {
        $this->scm = $scm;

        return $this;
    }
}
