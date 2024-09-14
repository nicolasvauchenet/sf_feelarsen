<?php

namespace App\DataFixtures;

use App\Entity\Album;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AlbumFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $album = (new Album())
            ->setName("J'ai un dragon à la maison")
            ->setCover('jai-un-dragon-a-la-maison.jpg')
            ->setReleasedAt(new \DateTimeImmutable('2015-02-28'));
        $manager->persist($album);
        $this->addReference('album-jai-un-dragon-a-la-maison', $album);

        $album = (new Album())
            ->setName('Willy')
            ->setCover('willy.jpg')
            ->setReleasedAt(new \DateTimeImmutable('2022-02-28'));
        $manager->persist($album);
        $this->addReference('album-willy', $album);

        $album = (new Album())
            ->setName('Atomic Cowboy')
            ->setCover('atomic-cowboy.jpg')
            ->setReleasedAt(new \DateTimeImmutable('2024-05-17'));
        $manager->persist($album);
        $this->addReference('album-atomic-cowboy', $album);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 8;
    }
}
