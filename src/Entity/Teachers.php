<?php

namespace App\Entity;

use App\Repository\TeachersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeachersRepository::class)]
class Teachers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lang = null;

    #[ORM\Column(length: 255)]
    private ?string $pictures = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $whatsapp = null;

    #[ORM\Column(length: 255)]
    private ?string $telegram = null;

    #[ORM\Column(length: 255)]
    private ?string $teams = null;

    #[ORM\Column(length: 255)]
    private ?string $viber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): static
    {
        $this->lang = $lang;

        return $this;
    }

    public function getPictures(): ?string
    {
        return $this->pictures;
    }

    public function setPictures(string $pictures): static
    {
        $this->pictures = $pictures;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getWhatsapp(): ?string
    {
        return $this->whatsapp;
    }

    public function setWhatsapp(string $whatsapp): static
    {
        $this->whatsapp = $whatsapp;

        return $this;
    }

    public function getTelegram(): ?string
    {
        return $this->telegram;
    }

    public function setTelegram(string $telegram): static
    {
        $this->telegram = $telegram;

        return $this;
    }

    public function getTeams(): ?string
    {
        return $this->teams;
    }

    public function setTeams(string $teams): static
    {
        $this->teams = $teams;

        return $this;
    }

    public function getViber(): ?string
    {
        return $this->viber;
    }

    public function setViber(string $viber): static
    {
        $this->viber = $viber;

        return $this;
    }
}
