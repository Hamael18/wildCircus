<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PriceRepository")
 */
class Price
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visitors", inversedBy="prices")
     */
    private $visitor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Period", inversedBy="prices")
     */
    private $periods;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(int $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getVisitor(): ?Visitors
    {
        return $this->visitor;
    }

    public function setVisitor(?Visitors $visitor): self
    {
        $this->visitor = $visitor;

        return $this;
    }

    public function getPeriods(): ?Period
    {
        return $this->periods;
    }

    public function setPeriods(?Period $periods): self
    {
        $this->periods = $periods;

        return $this;
    }
}
