<?php

namespace App\DataFixtures;

use App\Entity\Settings;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SettingsFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $settings = (new Settings())
            ->setSiteName('Féelarsen')
            ->setSitePunchline("La preuve vivante que le rock français n'est pas mort&nbsp;!")
            ->setSiteLogo('sitelogo.jpg')
            ->setSiteCover('sitecover.jpg')
            ->setContactCover('contactcover.jpg')
            ->setContactEmail('contact@feelarsen.fr')
            ->setContactArtistName('Jean-François Capéran')
            ->setContactArtistEmail('feelarsen.booking@gmail.com')
            ->setContactArtistPhone('+33 6 31 24 90 65')
            ->setContactTechName('Nicolas Vauché')
            ->setContactTechEmail('nvauche@gmail.com')
            ->setContactTechPhone('+33 6 83 57 30 67')
            ->setContactBookingName('Bastard Sound System')
            ->setContactBookingEmail('contact@bastardsoundsystem.org')
            ->setContactBookingPhone('+33 6 83 57 30 67')
            ->setMaxArtists(4);
        $manager->persist($settings);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 1;
    }
}
