<?php

namespace App\Entity;

use App\Repository\OpeningHourRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningHourRepository::class)]
class OpeningHour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::BIGINT)]
    private ?string $id = null;

    #[ORM\Column(type: Types::SMALLINT, unique: true)]
    private ?int $dayOfWeek = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $morningOpen = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $morningClose = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $afternoonOpen = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $afternoonClose = null;

    #[ORM\Column]
    private bool $isClosed = false;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDayOfWeek(): ?int
    {
        return $this->dayOfWeek;
    }

    public function setDayOfWeek(int $dayOfWeek): static
    {
        $this->dayOfWeek = $dayOfWeek;

        return $this;
    }

    public function getMorningOpen(): ?\DateTimeImmutable
    {
        return $this->morningOpen;
    }

    public function setMorningOpen(?\DateTimeImmutable $morningOpen): static
    {
        $this->morningOpen = $morningOpen;

        return $this;
    }

    public function getMorningClose(): ?\DateTimeImmutable
    {
        return $this->morningClose;
    }

    public function setMorningClose(?\DateTimeImmutable $morningClose): static
    {
        $this->morningClose = $morningClose;

        return $this;
    }

    public function getAfternoonOpen(): ?\DateTimeImmutable
    {
        return $this->afternoonOpen;
    }

    public function setAfternoonOpen(?\DateTimeImmutable $afternoonOpen): static
    {
        $this->afternoonOpen = $afternoonOpen;

        return $this;
    }

    public function getAfternoonClose(): ?\DateTimeImmutable
    {
        return $this->afternoonClose;
    }

    public function setAfternoonClose(?\DateTimeImmutable $afternoonClose): static
    {
        $this->afternoonClose = $afternoonClose;

        return $this;
    }

    public function isClosed(): bool
    {
        return $this->isClosed;
    }

    public function setIsClosed(bool $isClosed): static
    {
        $this->isClosed = $isClosed;

        return $this;
    }
}
