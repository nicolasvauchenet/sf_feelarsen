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
        // EPs
        $album = (new Album())
            ->setName('En attendant')
            ->setType('EP')
            ->setCover('en-attendant.jpg')
            ->setReleasedAt(new \DateTimeImmutable('2004-03-28'))
            ->setActive(true);
        $manager->persist($album);
        $this->addReference('album-en-attendant', $album);

        $album = (new Album())
            ->setName("J'ai un dragon à la maison")
            ->setType('EP')
            ->setCover('jai-un-dragon-a-la-maison.jpg')
            ->setReleasedAt(new \DateTimeImmutable('2015-02-28'))
            ->setActive(true);
        $manager->persist($album);
        $this->addReference('album-jai-un-dragon-a-la-maison', $album);

        $album = (new Album())
            ->setName('Willy')
            ->setType('EP')
            ->setCover('willy.jpg')
            ->setReleasedAt(new \DateTimeImmutable('2022-02-28'))
            ->setActive(true);
        $manager->persist($album);
        $this->addReference('album-willy', $album);

        $album = (new Album())
            ->setName('Atomic Cowboy')
            ->setType('EP')
            ->setCover('atomic-cowboy.jpg')
            ->setReleasedAt(new \DateTimeImmutable('2024-05-17'))
            ->setActive(true);
        $manager->persist($album);
        $this->addReference('album-atomic-cowboy', $album);

        // Lives
        $album = (new Album())
            ->setName('Live à Oléron')
            ->setType('Live')
            ->setCover('live-a-oleron.jpg')
            ->setReleasedAt(new \DateTimeImmutable('2024-07-26'))
            ->setActive(true);
        $manager->persist($album);
        $this->addReference('album-live-a-oleron', $album);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 7;
    }
}
