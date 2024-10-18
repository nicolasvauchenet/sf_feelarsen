<?php

namespace App\Entity;

use App\Repository\SettingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingsRepository::class)]
class Settings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $siteName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteSlogan = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteLogo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteCover = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteImage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactCover = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiteName(): ?string
    {
        return $this->siteName;
    }

    public function setSiteName(string $siteName): static
    {
        $this->siteName = $siteName;

        return $this;
    }

    public function getSiteSlogan(): ?string
    {
        return $this->siteSlogan;
    }

    public function setSiteSlogan(?string $siteSlogan): static
    {
        $this->siteSlogan = $siteSlogan;

        return $this;
    }

    public function getSiteLogo(): ?string
    {
        return $this->siteLogo;
    }

    public function setSiteLogo(?string $siteLogo): static
    {
        $this->siteLogo = $siteLogo;

        return $this;
    }

    public function getSiteCover(): ?string
    {
        return $this->siteCover;
    }

    public function setSiteCover(?string $siteCover): static
    {
        $this->siteCover = $siteCover;

        return $this;
    }

    public function getSiteImage(): ?string
    {
        return $this->siteImage;
    }

    public function setSiteImage(?string $siteImage): static
    {
        $this->siteImage = $siteImage;

        return $this;
    }

    public function getSiteUrl(): ?string
    {
        return $this->siteUrl;
    }

    public function setSiteUrl(?string $siteUrl): static
    {
        $this->siteUrl = $siteUrl;

        return $this;
    }

    public function getContactCover(): ?string
    {
        return $this->contactCover;
    }

    public function setContactCover(?string $contactCover): static
    {
        $this->contactCover = $contactCover;

        return $this;
    }
}
