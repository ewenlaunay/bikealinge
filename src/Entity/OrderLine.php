<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderLineRepository")
 */
class OrderLine
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $child;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="orderLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clothe", inversedBy="orderLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clothe_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOrderId(): ?Order
    {
        return $this->order_id;
    }

    public function setOrderId(?Order $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }

    public function getClotheId(): ?Clothe
    {
        return $this->clothe_id;
    }

    public function setClotheId(?Clothe $clothe_id): self
    {
        $this->clothe_id = $clothe_id;

        return $this;
    }
}
