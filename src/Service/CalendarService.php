<?php

namespace App\Service;

use App\Entity\Calendar;
use App\Repository\CalendarRepository;

final readonly class CalendarService
{
    public function __construct(private CalendarRepository $repository)
    {
    }

    public function getActiveCalendar(): Calendar
    {
        return $this->repository->findOneBy(['active' => true]);
    }
}
