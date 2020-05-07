<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="`order`")
 */
class Order
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
    private $reference;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MeansOfPaiement", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $means_of_paiement_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderLine", mappedBy="order_id")
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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getMeansOfPaiementId(): ?MeansOfPaiement
    {
        return $this->means_of_paiement_id;
    }

    public function setMeansOfPaiementId(?MeansOfPaiement $means_of_paiement_id): self
    {
        $this->means_of_paiement_id = $means_of_paiement_id;

        return $this;
    }

    public function getUsersId(): ?Users
    {
        return $this->users_id;
    }

    public function setUsersId(?Users $users_id): self
    {
        $this->users_id = $users_id;

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
            $orderLine->setOrderId($this);
        }

        return $this;
    }

    public function removeOrderLine(OrderLine $orderLine): self
    {
        if ($this->orderLines->contains($orderLine)) {
            $this->orderLines->removeElement($orderLine);
            // set the owning side to null (unless already changed)
            if ($orderLine->getOrderId() === $this) {
                $orderLine->setOrderId(null);
            }
        }

        return $this;
    }
}
