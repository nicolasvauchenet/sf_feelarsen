<?php

namespace App\DataFixtures;

use App\Entity\Date;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DateFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('Le Dropkick Bar')
            ->setCity('Limoges (87)')
            ->setStartAt(new \DateTimeImmutable('2024-03-23'))
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('Culture au grand jour')
            ->setCity('Saint-Bonnet-Briance (87)')
            ->setStartAt(new \DateTimeImmutable('2024-04-04'))
            ->setPoster('20240404.jpg')
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation("La vie d'Ange")
            ->setCity('La Douze (24)')
            ->setStartAt(new \DateTimeImmutable('2024-04-06'))
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('Féelarsen + Krav Boca + Les Ramoneurs de menhirs')
            ->setCity('Bordeaux (33)')
            ->setStartAt(new \DateTimeImmutable('2024-05-03'))
            ->setPoster('20240503.jpg')
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('Féelarsen + Krav Boca + Les Ramoneurs de menhirs')
            ->setCity('Limoges (87)')
            ->setStartAt(new \DateTimeImmutable('2024-05-04'))
            ->setPoster('20240504.jpg')
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation("Sortie de l'album Atomic Cowboy")
            ->setCity('Limoges (87)')
            ->setStartAt(new \DateTimeImmutable('2024-05-17'))
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('American Berry Customs')
            ->setCity('Roussines (36)')
            ->setStartAt(new \DateTimeImmutable('2024-05-19'))
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('Printemps de la Mauvendière')
            ->setCity('Limoges (87)')
            ->setStartAt(new \DateTimeImmutable('2024-06-01'))
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation("O'RDV")
            ->setCity('La Rochefoucault (16)')
            ->setStartAt(new \DateTimeImmutable('2024-06-07'))
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('Concert')
            ->setCity('Saint-Priest-la-Plaine (23)')
            ->setStartAt(new \DateTimeImmutable('2024-06-08'))
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('Festival Break In Fest')
            ->setCity('Saint-Laurent (23)')
            ->setStartAt(new \DateTimeImmutable('2024-06-22'))
            ->setPoster('20240622.jpg')
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('Festival Run Cap Sud')
            ->setCity('Argenton-sur-Creuse (36)')
            ->setStartAt(new \DateTimeImmutable('2024-07-06'))
            ->setPoster('20240706.jpg')
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('Plage de Santrop')
            ->setCity('Razès (87)')
            ->setStartAt(new \DateTimeImmutable('2024-07-17'))
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('Guinguette des Ferrières')
            ->setCity("Saint-Pierre d'Oléron (17)")
            ->setStartAt(new \DateTimeImmutable('2024-07-26'))
            ->setPoster('20240726.jpg')
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('Le Port du Lys')
            ->setCity('Salignac-sur-Charente (17)')
            ->setStartAt(new \DateTimeImmutable('2024-07-27'))
            ->setPoster('20240727.jpg')
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('Festival Les Cheminées Du Rock')
            ->setCity('Saillat-sur-Vienne (87)')
            ->setStartAt(new \DateTimeImmutable('2024-08-10'))
            ->setPoster('20240810.jpg')
            ->setActive(true);
        $manager->persist($date);

        $date = (new Date())
            ->setCalendar($this->getReference('calendar-2024'))
            ->setLocation('La Friche Des Ponts')
            ->setCity('Limoges (87)')
            ->setStartAt(new \DateTimeImmutable('2024-08-30'))
            ->setActive(true);
        $manager->persist($date);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 4;
    }
}
