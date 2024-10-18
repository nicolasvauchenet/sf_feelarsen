<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CalendarFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $calendar = (new Calendar())
            ->setName('Atomic Cowboy Tour 2024')
            ->setPoster('atomic-cowboy-tour-2024.jpg')
            ->setStartAt(new \DateTimeImmutable('2024-01-01'))
            ->setEndAt(new \DateTimeImmutable('2024-12-31'))
            ->setActive(true);
        $manager->persist($calendar);
        $this->addReference('calendar-2024', $calendar);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 2;
    }
}
