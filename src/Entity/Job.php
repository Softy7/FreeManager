<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?float $daily_rate = null;

    #[ORM\ManyToOne(inversedBy: 'jobs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Quote $quote = null;

    public const PRIORITY_WEAK = 0;
    public const PRIORITY_SMALL = 1;
    public const PRIORITY_MEDIUM = 2;
    public const PRIORITY_CRITICAL = 3;
    public const PRIORITY_BLOCKING = 4;

    #[ORM\Column]
    private ?int $priority = null;

    public const DIFFICULTY_EZ = 0;
    public const DIFFICULTY_EASY = 1;
    public const DIFFICULTY_NORMAL = 2;
    public const DIFFICULTY_HARDCORE = 3;
    public const DIFFICULTY_BIG_PROBLEM = 4;

    #[ORM\Column]
    private ?int $difficulty = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDailyRate(): ?float
    {
        return $this->daily_rate;
    }

    public function setDailyRate(float $daily_rate): static
    {
        $this->daily_rate = $daily_rate;

        return $this;
    }

    public function getQuote(): ?Quote
    {
        return $this->quote;
    }

    public function setQuote(?Quote $quote): static
    {
        $this->quote = $quote;

        return $this;
    }

    public function getTotalPrice(): float 
    {
        return $this->quantity * $this->daily_rate;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getPriorityLabel(): string
    {
        return match($this->priority) {
            self::PRIORITY_WEAK => 'Faible',
            self::PRIORITY_SMALL => 'Léger',
            self::PRIORITY_MEDIUM => 'Normal',
            self::PRIORITY_CRITICAL => 'Critique',
            self::PRIORITY_BLOCKING => 'Bloquant',
            default => 'Inconnu',
        };
    }

    public function getDifficultyLabel(): string
    {
        return match($this->difficulty) {
            self::DIFFICULTY_EZ => 'EZ',
            self::DIFFICULTY_EASY => 'Facile',
            self::DIFFICULTY_NORMAL => 'Normal',
            self::DIFFICULTY_HARDCORE => 'Difficile',
            self::DIFFICULTY_BIG_PROBLEM => 'Gros problème',
            default => 'Inconnu',
        };
    }
}
