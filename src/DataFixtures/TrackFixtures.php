<?php

namespace App\DataFixtures;

use App\Entity\Track;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TrackFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $track = (new Track())
            ->setPosition(1)
            ->setTitle("J'ai un dragon à la maison")
            ->setFileName('jai-un-dragon-a-la-maison.mp3')
            ->setAlbum($this->getReference('album-jai-un-dragon-a-la-maison'));
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(1)
            ->setTitle('Willy mon coq à moi')
            ->setFileName('willy-mon-coq-a-moi.mp3')
            ->setAlbum($this->getReference('album-willy'));
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(2)
            ->setTitle("Ton ch'val dans mon verre")
            ->setFileName('ton-chval-dans-mon-verre.mp3')
            ->setAlbum($this->getReference('album-willy'));
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(3)
            ->setTitle('Vaisseau Volvo')
            ->setFileName('vaisseau-volvo.mp3')
            ->setAlbum($this->getReference('album-willy'));
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(4)
            ->setTitle('Mon héroïne')
            ->setFileName('mon-heroine.mp3')
            ->setAlbum($this->getReference('album-willy'));
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(5)
            ->setTitle('Par les routes')
            ->setFileName('par-les-routes.mp3')
            ->setAlbum($this->getReference('album-willy'));
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(1)
            ->setTitle('Atomic Cowboy Acte 1')
            ->setFileName('atomic-cowboy-acte-1.mp3')
            ->setAlbum($this->getReference('album-atomic-cowboy'));
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(2)
            ->setTitle('Atomic Cowboy Acte 2')
            ->setFileName('atomic-cowboy-acte-2.mp3')
            ->setAlbum($this->getReference('album-atomic-cowboy'));
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(3)
            ->setTitle('Ce qui nous tient')
            ->setFileName('ce-qui-nous-tient.mp3')
            ->setAlbum($this->getReference('album-atomic-cowboy'));
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(4)
            ->setTitle('Quadragénaire')
            ->setFileName('quadragenaire.mp3')
            ->setAlbum($this->getReference('album-atomic-cowboy'));
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(5)
            ->setTitle('Idée sale')
            ->setFileName('idee-sale.mp3')
            ->setAlbum($this->getReference('album-atomic-cowboy'));
        $manager->persist($track);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 9;
    }
}
