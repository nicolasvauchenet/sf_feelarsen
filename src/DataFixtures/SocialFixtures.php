<?php

namespace App\DataFixtures;

use App\Entity\Social;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SocialFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $social = (new Social())
            ->setName('Spotify')
            ->setIcon('bi:spotify')
            ->setTitle('Écoutez Féelarsen sur Spotify')
            ->setUrl('https://open.spotify.com/intl-fr/artist/7dTRyO5JW320DZg7Y3hDrZ?si=CHVAM0PBSBq5Icsd2RhJWQ')
            ->setActive(true);
        $manager->persist($social);

        $social = (new Social())
            ->setName('Deezer')
            ->setIcon('arcticons:deezer')
            ->setTitle('Écoutez Féelarsen sur Deezer')
            ->setUrl('https://deezer.page.link/adx4emNb4MgkwfNf6')
            ->setActive(true);
        $manager->persist($social);

        $social = (new Social())
            ->setName('Apple Music')
            ->setIcon('cib:apple-music')
            ->setTitle('Écoutez Féelarsen sur Apple Music')
            ->setUrl('https://music.apple.com/fr/artist/f%C3%A9elarsen/1610754643')
            ->setActive(true);
        $manager->persist($social);

        $social = (new Social())
            ->setName('Bandcamp')
            ->setIcon('cib:bandcamp')
            ->setTitle('Suivez Féelarsen sur Bandcamp')
            ->setUrl('https://feelarsenproduction.bandcamp.com/album/willy')
            ->setActive(true);
        $manager->persist($social);

        $social = (new Social())
            ->setName('Facebook')
            ->setIcon('bi:facebook')
            ->setTitle('Suivez Féelarsen sur Facebook')
            ->setUrl('https://www.facebook.com/LesFeelarsen')
            ->setActive(true);
        $manager->persist($social);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 6;
    }
}
