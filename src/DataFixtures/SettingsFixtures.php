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
            ->setSiteSlogan("La preuve vivante que le rock français n'est pas mort")
            ->setSiteLogo('sitelogo.png')
            ->setSiteCover('sitecover.jpg')
            ->setSiteImage('https://feelarsen.fr/uploads/settings/siteimage.png')
            ->setSiteUrl('https://feelarsen.fr')
            ->setContactCover('contactcover.jpg');
        $manager->persist($settings);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 1;
    }
}
