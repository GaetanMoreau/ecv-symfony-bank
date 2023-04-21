<?php

namespace App\Entity;

use App\Repository\RechargeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RechargeRepository::class)]
class Recharge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\ManyToOne(inversedBy: 'recharge')]
    private ?Account $compte = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $recharge_date = null;

    #[ORM\Column(length: 255)]
    private ?string $carte = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCompte(): ?Account
    {
        return $this->compte;
    }

    public function setCompte(?Account $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

    public function getRechargeDate(): ?\DateTimeInterface
    {
        return $this->recharge_date;
    }

    public function setRechargeDate(\DateTimeInterface $recharge_date): self
    {
        $this->recharge_date = $recharge_date;

        return $this;
    }

    public function getCarte(): ?string
    {
        return $this->carte;
    }

    public function setCarte(int $carte): self
    {
        $this->carte = $carte;

        return $this;
    }
}
