<?php

namespace App\Entity;

use App\Repository\OrderContactLogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderContactLogRepository::class)]
class OrderContactLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::BIGINT)]
    private ?string $id = null;

    #[ORM\Column(length: 50)]
    private ?string $contactMethod = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $reason = null;

    #[ORM\Column]
    private \DateTimeImmutable $contactedAt;

    #[ORM\ManyToOne(inversedBy: 'contactLogs')]
    #[ORM\JoinColumn(
        name: 'order_id',
        referencedColumnName: 'id',
        nullable: false,
        onDelete: 'CASCADE'
    )]
    private ?CustomerOrder $customerOrder = null;

    #[ORM\ManyToOne(inversedBy: 'orderContactLogs')]
    #[ORM\JoinColumn(
        name: 'employee_id',
        referencedColumnName: 'id',
        nullable: false
    )]
    private ?User $employee = null;

    public function __construct()
    {
        $this->contactedAt = new \DateTimeImmutable();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getContactMethod(): ?string
    {
        return $this->contactMethod;
    }

    public function setContactMethod(string $contactMethod): static
    {
        $this->contactMethod = $contactMethod;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): static
    {
        $this->reason = $reason;

        return $this;
    }

    public function getContactedAt(): \DateTimeImmutable
    {
        return $this->contactedAt;
    }

    public function setContactedAt(\DateTimeImmutable $contactedAt): static
    {
        $this->contactedAt = $contactedAt;

        return $this;
    }

    public function getCustomerOrder(): ?CustomerOrder
    {
        return $this->customerOrder;
    }

    public function setCustomerOrder(?CustomerOrder $customerOrder): static
    {
        $this->customerOrder = $customerOrder;

        return $this;
    }

    public function getEmployee(): ?User
    {
        return $this->employee;
    }

    public function setEmployee(?User $employee): static
    {
        $this->employee = $employee;

        return $this;
    }
}
