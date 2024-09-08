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
    private ?string $sitePunchline = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteLogo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteCover = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactCover = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactEmail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactArtistName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactArtistEmail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactArtistPhone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactTechName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactTechEmail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactTechPhone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactBookingName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactBookingEmail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactBookingPhone = null;

    #[ORM\Column]
    private ?int $maxArtists = null;

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

    public function getSitePunchline(): ?string
    {
        return $this->sitePunchline;
    }

    public function setSitePunchline(?string $sitePunchline): static
    {
        $this->sitePunchline = $sitePunchline;

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

    public function getContactCover(): ?string
    {
        return $this->contactCover;
    }

    public function setContactCover(?string $contactCover): static
    {
        $this->contactCover = $contactCover;

        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(?string $contactEmail): static
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    public function getContactArtistName(): ?string
    {
        return $this->contactArtistName;
    }

    public function setContactArtistName(?string $contactArtistName): static
    {
        $this->contactArtistName = $contactArtistName;

        return $this;
    }

    public function getContactArtistEmail(): ?string
    {
        return $this->contactArtistEmail;
    }

    public function setContactArtistEmail(?string $contactArtistEmail): static
    {
        $this->contactArtistEmail = $contactArtistEmail;

        return $this;
    }

    public function getContactArtistPhone(): ?string
    {
        return $this->contactArtistPhone;
    }

    public function setContactArtistPhone(?string $contactArtistPhone): static
    {
        $this->contactArtistPhone = $contactArtistPhone;

        return $this;
    }

    public function getContactTechName(): ?string
    {
        return $this->contactTechName;
    }

    public function setContactTechName(?string $contactTechName): static
    {
        $this->contactTechName = $contactTechName;

        return $this;
    }

    public function getContactTechEmail(): ?string
    {
        return $this->contactTechEmail;
    }

    public function setContactTechEmail(?string $contactTechEmail): static
    {
        $this->contactTechEmail = $contactTechEmail;

        return $this;
    }

    public function getContactTechPhone(): ?string
    {
        return $this->contactTechPhone;
    }

    public function setContactTechPhone(?string $contactTechPhone): static
    {
        $this->contactTechPhone = $contactTechPhone;

        return $this;
    }

    public function getContactBookingName(): ?string
    {
        return $this->contactBookingName;
    }

    public function setContactBookingName(?string $contactBookingName): static
    {
        $this->contactBookingName = $contactBookingName;

        return $this;
    }

    public function getContactBookingEmail(): ?string
    {
        return $this->contactBookingEmail;
    }

    public function setContactBookingEmail(?string $contactBookingEmail): static
    {
        $this->contactBookingEmail = $contactBookingEmail;

        return $this;
    }

    public function getContactBookingPhone(): ?string
    {
        return $this->contactBookingPhone;
    }

    public function setContactBookingPhone(?string $contactBookingPhone): static
    {
        $this->contactBookingPhone = $contactBookingPhone;

        return $this;
    }

    public function getMaxArtists(): ?int
    {
        return $this->maxArtists;
    }

    public function setMaxArtists(int $maxArtists): static
    {
        $this->maxArtists = $maxArtists;

        return $this;
    }
}
