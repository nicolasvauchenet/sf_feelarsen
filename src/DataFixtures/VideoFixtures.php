<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VideoFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $video = (new Video())
            ->setName("Ton ch'val dans mon verre")
            ->setType('clip')
            ->setFileName('ton-chval-dans-mon-verre.mp4')
            ->setReleasedAt(new \DateTimeImmutable('2022-04-25'));
        $manager->persist($video);

        $video = (new Video())
            ->setName('Quadragénaire')
            ->setType('clip')
            ->setFileName('quadragenaire.mp4')
            ->setReleasedAt(new \DateTimeImmutable('2024-10-01'));
        $manager->persist($video);

        $video = (new Video())
            ->setName('Willy')
            ->setType('live')
            ->setFileName('willy.mp4')
            ->setReleasedAt(new \DateTimeImmutable('2024-07-26'));
        $manager->persist($video);

        $video = (new Video())
            ->setName('Atomic Cowboy - Acte II')
            ->setType('live')
            ->setFileName('atomic-cowboy-acte-ii.mp4')
            ->setReleasedAt(new \DateTimeImmutable('2024-07-26'));
        $manager->persist($video);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 10;
    }
}
