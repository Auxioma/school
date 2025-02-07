<?php

namespace App\Entity;

use App\Repository\TranslationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TranslationRepository::class)]
class Translation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $key = null;

    #[ORM\Column(length: 10)]
    private ?string $locale = null;

    #[ORM\Column(type: 'text')]
    private ?string $message = null;

    // Getters et Setters
    public function getId(): ?int { return $this->id; }

    public function getKey(): ?string { return $this->key; }
    public function setKey(string $key): self { $this->key = $key; return $this; }

    public function getLocale(): ?string { return $this->locale; }
    public function setLocale(string $locale): self { $this->locale = $locale; return $this; }

    public function getMessage(): ?string { return $this->message; }
    public function setMessage(string $message): self { $this->message = $message; return $this; }

}
