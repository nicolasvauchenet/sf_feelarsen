<?php

namespace App\Service;

use App\Repository\SocialRepository;

class SocialService
{
    private SocialRepository $socialRepository;

    public function __construct(SocialRepository $socialRepository)
    {
        $this->socialRepository = $socialRepository;
    }

    public function getSocials(): array
    {
        return $this->socialRepository->findBy(['active' => true]);
    }
}
