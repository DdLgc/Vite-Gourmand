<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::BIGINT)]
    private ?string $id = null;

    #[ORM\Column(length: 150)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $conditions = null;

    #[ORM\Column]
    private ?int $minimumPeople = null;

    #[ORM\Column]
    private ?int $basePriceCents = null;

    #[ORM\Column]
    private int $availableStock = 0;

    #[ORM\Column(length: 50)]
    private ?string $theme = null;

    #[ORM\Column(length: 50)]
    private ?string $diet = null;

    #[ORM\Column]
    private bool $isActive = true;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    private \DateTimeImmutable $updatedAt;

    /**
     * @var Collection<int, MenuImage>
     */
    #[ORM\OneToMany(targetEntity: MenuImage::class, mappedBy: 'menu')]
    private Collection $images;

    /**
     * @var Collection<int, Dish>
     */
    #[ORM\ManyToMany(targetEntity: Dish::class, inversedBy: 'menus')]
    #[ORM\JoinTable(name: 'menu_dish')]
    #[ORM\JoinColumn(name: 'menu_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'dish_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Collection $dishes;

    /**
     * @var Collection<int, CustomerOrder>
     */
    #[ORM\OneToMany(targetEntity: CustomerOrder::class, mappedBy: 'menu')]
    private Collection $orders;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getConditions(): ?string
    {
        return $this->conditions;
    }

    public function setConditions(string $conditions): static
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function getMinimumPeople(): ?int
    {
        return $this->minimumPeople;
    }

    public function setMinimumPeople(int $minimumPeople): static
    {
        $this->minimumPeople = $minimumPeople;

        return $this;
    }

    public function getBasePriceCents(): ?int
    {
        return $this->basePriceCents;
    }

    public function setBasePriceCents(int $basePriceCents): static
    {
        $this->basePriceCents = $basePriceCents;

        return $this;
    }

    public function getAvailableStock(): int
    {
        return $this->availableStock;
    }

    public function setAvailableStock(int $availableStock): static
    {
        $this->availableStock = $availableStock;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getDiet(): ?string
    {
        return $this->diet;
    }

    public function setDiet(string $diet): static
    {
        $this->diet = $diet;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->images = new ArrayCollection();
        $this->dishes = new ArrayCollection();
        $this->orders = new ArrayCollection();
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

    /**
     * @return Collection<int, MenuImage>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(MenuImage $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setMenu($this);
        }

        return $this;
    }

    public function removeImage(MenuImage $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getMenu() === $this) {
                $image->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dish>
     */
    public function getDishes(): Collection
    {
        return $this->dishes;
    }

    public function addDish(Dish $dish): static
    {
        if (!$this->dishes->contains($dish)) {
            $this->dishes->add($dish);
        }

        return $this;
    }

    public function removeDish(Dish $dish): static
    {
        $this->dishes->removeElement($dish);

        return $this;
    }

    /**
     * @return Collection<int, CustomerOrder>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(CustomerOrder $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setMenu($this);
        }

        return $this;
    }

    public function removeOrder(CustomerOrder $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getMenu() === $this) {
                $order->setMenu(null);
            }
        }

        return $this;
    }
}
