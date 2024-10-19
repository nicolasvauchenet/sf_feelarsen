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
        // Clips
        $video = (new Video())
            ->setTitle('FÉELARSEN - Quadragénaire [ Clip Officiel ]')
            ->setType('Clip')
            ->setDescription("Le premier clip officiel de Féelarsen extrait de l'album Atomic Cowboy")
            ->setThumbnail('X4xr-1c-14CMxZSaU2Q')
            ->setUrl('x96ebum')
            ->setDuration('P327S')
            ->setReleasedAt(new \DateTimeImmutable('2024-10-12'))
            ->setActive(true);
        $manager->persist($video);

        // Lives
        $video = (new Video())
            ->setTitle("Atomic Cowboy - Acte I [ CCM John Lennon 2024 ]")
            ->setType('Live')
            ->setDescription("Le concert de Féelarsen au CCM John Lennon de Limoges en 2024, en première partie de Krav Boca et des Ramoneurs de Menhirs")
            ->setThumbnail('X4zVS1c-1PV-71FK4')
            ->setUrl('x96eh24')
            ->setDuration('P64S')
            ->setReleasedAt(new \DateTimeImmutable('2024-05-04'))
            ->setActive(true);
        $manager->persist($video);

        $video = (new Video())
            ->setTitle("Atomic Cowboy - Acte II [ Saint-Pierre d'Oléron 2024 ]")
            ->setType('Live')
            ->setDescription("Le concert mémorable de Féelarsen à Saint-Pierre d'Oléron en 2024")
            ->setThumbnail('X4zR-1c-1Or7lkrSS')
            ->setUrl('x96egvy')
            ->setDuration('P277S')
            ->setReleasedAt(new \DateTimeImmutable('2024-07-26'))
            ->setActive(true);
        $manager->persist($video);

        $video = (new Video())
            ->setTitle("Willy [ Saint-Pierre d'Oléron 2024 ]")
            ->setType('Live')
            ->setDescription("Le concert mémorable de Féelarsen à Saint-Pierre d'Oléron en 2024")
            ->setThumbnail('X4zTQ1c-1PZtjnXfJ')
            ->setUrl('x96egyi')
            ->setDuration('P217S')
            ->setReleasedAt(new \DateTimeImmutable('2024-07-26'))
            ->setActive(true);
        $manager->persist($video);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 9;
    }
}
