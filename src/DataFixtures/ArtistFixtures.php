<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArtistFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $artist = (new Artist())
            ->setName('JF')
            ->setSlug('jf')
            ->setInstrument('Guitare, Chant lead')
            ->setPhoto('jf.jpg');
        $manager->persist($artist);

        $artist = (new Artist())
            ->setName('Ben')
            ->setSlug('ben')
            ->setInstrument('Basse, Chœurs')
            ->setPhoto('ben.jpg');
        $manager->persist($artist);

        $artist = (new Artist())
            ->setName('Manu')
            ->setSlug('manu')
            ->setInstrument('Batterie, Chœurs')
            ->setPhoto('manu.jpg');
        $manager->persist($artist);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 4;
    }
}
