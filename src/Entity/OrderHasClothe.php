<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderHasClotheRepository")
 */
class OrderHasClothe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="orderHasClothes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clothe", inversedBy="orderHasClothes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clothe;

    /**
     * @ORM\Column(type="boolean")
     */
    private $adult;

    /**
     * @ORM\Column(type="boolean")
     */
    private $child;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getClothe(): ?Clothe
    {
        return $this->clothe;
    }

    public function setClothe(?Clothe $clothe): self
    {
        $this->clothe = $clothe;

        return $this;
    }

    public function getAdult(): ?bool
    {
        return $this->adult;
    }

    public function setAdult(bool $adult): self
    {
        $this->adult = $adult;

        return $this;
    }

    public function getChild(): ?bool
    {
        return $this->child;
    }

    public function setChild(bool $child): self
    {
        $this->child = $child;

        return $this;
    }

    public function __toString()
    {
        return (string)$this->order;
    }

    public function getWeight()
    {
        if ($this->getChild()) {
            return $this->getClothe()->getWeightChild();

        } else {
            return $this->getClothe()->getWeightAdult();

        }
    }
}
