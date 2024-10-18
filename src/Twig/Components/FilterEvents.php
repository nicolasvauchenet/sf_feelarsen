<?php

namespace App\Twig\Components;

use App\Entity\Calendar;
use App\Repository\EventRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('FilterEvents', template: 'front_office/components/events.html.twig')]
class FilterEvents
{
    use DefaultActionTrait;

    private EventRepository $eventRepository;

    #[LiveProp]
    public Calendar $calendar;

    #[LiveProp]
    public int $calendarId;

    #[LiveProp(writable: true)]
    public string $month = '';

    #[LiveProp(writable: true)]
    public string $city = '';

    #[LiveProp(writable: true)]
    public string $department = '';

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getEvents(): array
    {
        return $this->eventRepository->findEventsByFilters($this->calendarId, $this->month, $this->city, $this->department);
    }
}
