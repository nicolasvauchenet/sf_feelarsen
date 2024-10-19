<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $contact = (new Contact())
            ->setName('Jean-François Capéran')
            ->setType('Contact Artistique')
            ->setEmail('feelarsen.booking@gmail.com')
            ->setPhone('06 31 24 90 65');
        $manager->persist($contact);

        $contact = (new Contact())
            ->setName('Nicolas Vauché')
            ->setType('Contact Technique')
            ->setEmail('nvauche@gmail.com')
            ->setPhone('06 83 57 30 67');
        $manager->persist($contact);

        $contact = (new Contact())
            ->setName('Bastard Sound System')
            ->setType('Contact Booking')
            ->setEmail('contact@bastardsoundsystem.org')
            ->setPhone('06 83 57 30 67');
        $manager->persist($contact);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 10;
    }
}
