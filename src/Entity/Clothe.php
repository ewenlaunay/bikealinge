<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClotheRepository")
 */
class Clothe
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
    private $tititle;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $weight_adult;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $weight_child;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderLine", mappedBy="clothe_id")
     */
    private $orderLines;

    public function __construct()
    {
        $this->orderLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTititle(): ?string
    {
        return $this->tititle;
    }

    public function setTititle(string $tititle): self
    {
        $this->tititle = $tititle;

        return $this;
    }

    public function getWeightAdult(): ?string
    {
        return $this->weight_adult;
    }

    public function setWeightAdult(string $weight_adult): self
    {
        $this->weight_adult = $weight_adult;

        return $this;
    }

    public function getWeightChild(): ?string
    {
        return $this->weight_child;
    }

    public function setWeightChild(string $weight_child): self
    {
        $this->weight_child = $weight_child;

        return $this;
    }

    /**
     * @return Collection|OrderLine[]
     */
    public function getOrderLines(): Collection
    {
        return $this->orderLines;
    }

    public function addOrderLine(OrderLine $orderLine): self
    {
        if (!$this->orderLines->contains($orderLine)) {
            $this->orderLines[] = $orderLine;
            $orderLine->setClotheId($this);
        }

        return $this;
    }

    public function removeOrderLine(OrderLine $orderLine): self
    {
        if ($this->orderLines->contains($orderLine)) {
            $this->orderLines->removeElement($orderLine);
            // set the owning side to null (unless already changed)
            if ($orderLine->getClotheId() === $this) {
                $orderLine->setClotheId(null);
            }
        }

        return $this;
    }
}
