<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EventFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('Le Dropkick Bar')
            ->setCity('Limoges')
            ->setDepartment('87')
            ->setStartAt(new \DateTimeImmutable('2024-03-23'))
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('Culture au grand jour')
            ->setCity('Saint-Bonnet-Briance')
            ->setDepartment('87')
            ->setStartAt(new \DateTimeImmutable('2024-04-04'))
            ->setPoster('20240404.jpg')
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName("La vie d'Ange")
            ->setCity('La Douze')
            ->setDepartment('24')
            ->setStartAt(new \DateTimeImmutable('2024-04-06'))
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('Féelarsen + Krav Boca + Les Ramoneurs de menhirs')
            ->setCity('Bordeaux')
            ->setDepartment('33')
            ->setStartAt(new \DateTimeImmutable('2024-05-03'))
            ->setPoster('20240503.jpg')
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('Féelarsen + Krav Boca + Les Ramoneurs de menhirs')
            ->setCity('Limoges')
            ->setDepartment('87')
            ->setStartAt(new \DateTimeImmutable('2024-05-04'))
            ->setPoster('20240504.jpg')
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName("Sortie de l'album Atomic Cowboy")
            ->setLocation('CALM')
            ->setCity('Limoges')
            ->setDepartment('87')
            ->setStartAt(new \DateTimeImmutable('2024-05-17'))
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('American Berry Customs')
            ->setCity('Roussines')
            ->setDepartment('36')
            ->setStartAt(new \DateTimeImmutable('2024-05-19'))
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('Printemps de la Mauvendière')
            ->setCity('Limoges')
            ->setDepartment('87')
            ->setStartAt(new \DateTimeImmutable('2024-06-01'))
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName("O'RDV")
            ->setCity('La Rochefoucault')
            ->setDepartment('16')
            ->setStartAt(new \DateTimeImmutable('2024-06-07'))
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('Concert rural')
            ->setLocation('Salle des fêtes')
            ->setCity('Saint-Priest-la-Plaine')
            ->setDepartment('23')
            ->setStartAt(new \DateTimeImmutable('2024-06-08'))
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('Festival Break In Fest')
            ->setCity('Saint-Laurent')
            ->setDepartment('23')
            ->setStartAt(new \DateTimeImmutable('2024-06-22'))
            ->setPoster('20240622.jpg')
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('Festival Run Cap Sud')
            ->setCity('Argenton-sur-Creuse')
            ->setDepartment('36')
            ->setStartAt(new \DateTimeImmutable('2024-07-06'))
            ->setPoster('20240706.jpg')
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('Plage de Santrop')
            ->setCity('Razès')
            ->setDepartment('87')
            ->setStartAt(new \DateTimeImmutable('2024-07-17'))
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('Guinguette des Ferrières')
            ->setCity("Saint-Pierre d'Oléron")
            ->setDepartment('17')
            ->setStartAt(new \DateTimeImmutable('2024-07-26'))
            ->setPoster('20240726.jpg')
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('Le Port du Lys')
            ->setCity('Salignac-sur-Charente')
            ->setDepartment('17')
            ->setStartAt(new \DateTimeImmutable('2024-07-27'))
            ->setPoster('20240727.jpg')
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('Festival Les Cheminées Du Rock')
            ->setCity('Saillat-sur-Vienne')
            ->setDepartment('87')
            ->setStartAt(new \DateTimeImmutable('2024-08-10'))
            ->setPoster('20240810.jpg')
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName('La Friche Des Ponts')
            ->setCity('Limoges')
            ->setDepartment('87')
            ->setStartAt(new \DateTimeImmutable('2024-08-30'))
            ->setActive(true);
        $manager->persist($event);

        $event = (new Event())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setName("Zanaly + Féelarsen + Bob's Not Dead")
            ->setLocation('La Quincaillerie Numérique')
            ->setCity('Guéret')
            ->setDepartment('23')
            ->setStartAt(new \DateTimeImmutable('2024-12-07'))
            ->setActive(true);
        $manager->persist($event);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 3;
    }
}
