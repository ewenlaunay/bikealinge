<?php

namespace App\Entity;

use DateTimeInterface;
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
    private $creationDate;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="orders", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MeanOfPaiement", inversedBy="orders")
     */
    private $meanOfPaiement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderHasClothe", mappedBy="order")
     */
    private $orderHasClothes;


    /**
     * @ORM\ManyToOne(targetEntity=Formule::class, inversedBy="orders")
     */
    private $formule;



    public function __construct()
    {
        $this->orderHasClothes = new ArrayCollection();
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

    public function getCreationDate(): ?DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMeanOfPaiement(): ?MeanOfPaiement
    {
        return $this->meanOfPaiement;
    }

    public function setMeanOfPaiement(?MeanOfPaiement $meanOfPaiement): self
    {
        $this->meanOfPaiement = $meanOfPaiement;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|OrderHasClothe[]
     */
    public function getOrderHasClothes(): Collection
    {
        return $this->orderHasClothes;
    }

    public function addOrderHasClothes(OrderHasClothe $orderHasClothes): self
    {
        if (!$this->orderHasClothes->contains($orderHasClothes)) {
            $this->orderHasClothes[] = $orderHasClothes;
            $orderHasClothes->setOrder($this);
        }

        return $this;
    }

    public function removeOrderHasClothes(OrderHasClothe $orderHasClothes): self
    {
        if ($this->orderHasClothes->contains($orderHasClothes)) {
            $this->orderHasClothes->removeElement($orderHasClothes);
            // set the owning side to null (unless already changed)
            if ($orderHasClothes->getOrder() === $this) {
                $orderHasClothes->setOrder(null);
            }
        }

        return $this;
    }


    public function getFormule(): ?Formule
    {
        return $this->formule;
    }

    public function setFormule(?Formule $formule): self
    {
        $this->formule = $formule;

        return $this;
    }

}

