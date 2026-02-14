<?php

namespace App\Service;

use App\Entity\Calendar;
use App\Repository\EventRepository;

class EventService
{
    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getMonths(Calendar $calendar): array
    {
        return $this->eventRepository->findAllMonths($calendar);
    }

    public function getCities(Calendar $calendar): array
    {
        return $this->eventRepository->findAllCities($calendar);
    }

    public function getDepartments(Calendar $calendar): array
    {
        return $this->eventRepository->findAllDepartments($calendar);
    }

    public function getMonthNames(array $monthNumbers): array
    {
        $months = [
            1 => 'Janvier',
            2 => 'Février',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Août',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Décembre',
        ];

        $monthNames = [];
        foreach ($monthNumbers as $monthNumber) {
            $monthNames[$monthNumber] = $months[$monthNumber];
        }

        return $monthNames;
    }
}
