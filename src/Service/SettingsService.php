<?php

namespace App\Service;

use App\Entity\Settings;
use App\Repository\SettingsRepository;

class SettingsService
{
    private ?Settings $settings = null;
    private ?SettingsRepository $settingsRepository;

    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    private function loadSettings(): void
    {
        if($this->settings === null) {
            $this->settings = $this->settingsRepository->find(1);
        }
    }

    public function getSettings(): ?Settings
    {
        $this->loadSettings();

        return $this->settings;
    }
}
