<?php

namespace App\Entity;

use App\Repository\CustomerOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerOrderRepository::class)]
class CustomerOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::BIGINT)]
    private ?string $id = null;

    #[ORM\Column]
    private ?int $peopleCount = null;

    #[ORM\Column(length: 255)]
    private ?string $deliveryAddress = null;

    #[ORM\Column(length: 10)]
    private ?string $deliveryPostalCode = null;

    #[ORM\Column(length: 100)]
    private ?string $deliveryCity = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $deliveryDate = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $deliveryTime = null;

    #[ORM\Column]
    private ?int $menuAmountCents = null;

    #[ORM\Column]
    private int $discountAmountCents = 0;

    #[ORM\Column]
    private int $deliveryAmountCents = 0;

    #[ORM\Column]
    private ?int $totalAmountCents = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    private \DateTimeImmutable $updatedAt;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(name: 'menu_id', referencedColumnName: 'id', nullable: false)]
    private ?Menu $menu = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private ?User $customer = null;

    /**
     * @var Collection<int, OrderStatusHistory>
     */
    #[ORM\OneToMany(targetEntity: OrderStatusHistory::class, mappedBy: 'customerOrder')]
    private Collection $statusHistory;

    /**
     * @var Collection<int, OrderContactLog>
     */
    #[ORM\OneToMany(targetEntity: OrderContactLog::class, mappedBy: 'customerOrder')]
    private Collection $contactLogs;

    #[ORM\OneToOne(mappedBy: 'customerOrder', targetEntity: Review::class)]
    private ?Review $review = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->statusHistory = new ArrayCollection();
        $this->contactLogs = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getPeopleCount(): ?int
    {
        return $this->peopleCount;
    }

    public function setPeopleCount(int $peopleCount): static
    {
        $this->peopleCount = $peopleCount;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(string $deliveryAddress): static
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    public function getDeliveryPostalCode(): ?string
    {
        return $this->deliveryPostalCode;
    }

    public function setDeliveryPostalCode(string $deliveryPostalCode): static
    {
        $this->deliveryPostalCode = $deliveryPostalCode;

        return $this;
    }

    public function getDeliveryCity(): ?string
    {
        return $this->deliveryCity;
    }

    public function setDeliveryCity(string $deliveryCity): static
    {
        $this->deliveryCity = $deliveryCity;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeImmutable
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(\DateTimeImmutable $deliveryDate): static
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getDeliveryTime(): ?\DateTimeImmutable
    {
        return $this->deliveryTime;
    }

    public function setDeliveryTime(\DateTimeImmutable $deliveryTime): static
    {
        $this->deliveryTime = $deliveryTime;

        return $this;
    }

    public function getMenuAmountCents(): ?int
    {
        return $this->menuAmountCents;
    }

    public function setMenuAmountCents(int $menuAmountCents): static
    {
        $this->menuAmountCents = $menuAmountCents;

        return $this;
    }

    public function getDiscountAmountCents(): int
    {
        return $this->discountAmountCents;
    }

    public function setDiscountAmountCents(int $discountAmountCents): static
    {
        $this->discountAmountCents = $discountAmountCents;

        return $this;
    }

    public function getDeliveryAmountCents(): int
    {
        return $this->deliveryAmountCents;
    }

    public function setDeliveryAmountCents(int $deliveryAmountCents): static
    {
        $this->deliveryAmountCents = $deliveryAmountCents;

        return $this;
    }

    public function getTotalAmountCents(): ?int
    {
        return $this->totalAmountCents;
    }

    public function setTotalAmountCents(int $totalAmountCents): static
    {
        $this->totalAmountCents = $totalAmountCents;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): static
    {
        $this->menu = $menu;

        return $this;
    }

    public function getCustomer(): ?User
    {
        return $this->customer;
    }

    public function setCustomer(?User $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection<int, OrderStatusHistory>
     */
    public function getStatusHistory(): Collection
    {
        return $this->statusHistory;
    }

    public function addStatusHistory(OrderStatusHistory $statusHistory): static
    {
        if (!$this->statusHistory->contains($statusHistory)) {
            $this->statusHistory->add($statusHistory);
            $statusHistory->setCustomerOrder($this);
        }

        return $this;
    }

    public function removeStatusHistory(OrderStatusHistory $statusHistory): static
    {
        if ($this->statusHistory->removeElement($statusHistory)) {
            // set the owning side to null (unless already changed)
            if ($statusHistory->getCustomerOrder() === $this) {
                $statusHistory->setCustomerOrder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderContactLog>
     */
    public function getContactLogs(): Collection
    {
        return $this->contactLogs;
    }

    public function addContactLog(OrderContactLog $contactLog): static
    {
        if (!$this->contactLogs->contains($contactLog)) {
            $this->contactLogs->add($contactLog);
            $contactLog->setCustomerOrder($this);
        }

        return $this;
    }

    public function removeContactLog(OrderContactLog $contactLog): static
    {
        if ($this->contactLogs->removeElement($contactLog)) {
            // set the owning side to null (unless already changed)
            if ($contactLog->getCustomerOrder() === $this) {
                $contactLog->setCustomerOrder(null);
            }
        }

        return $this;
    }

    public function getReview(): ?Review
    {
        return $this->review;
    }

    public function setReview(?Review $review): static
    {
        $this->review = $review;

        if ($review !== null && $review->getCustomerOrder() !== $this) {
            $review->setCustomerOrder($this);
        }

        return $this;
    }
}
