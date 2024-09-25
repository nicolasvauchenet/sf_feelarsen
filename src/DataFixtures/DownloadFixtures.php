<?php

namespace App\DataFixtures;

use App\Entity\Download;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DownloadFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $document = (new Download())
            ->setDocumentName('Fiche Technique')
            ->setFileName('feelarsen-fiche-technique.pdf')
            ->setColor('info')
            ->setActive(true);
        $manager->persist($document);

        $document = (new Download())
            ->setDocumentName('Rider')
            ->setFileName('feelarsen-rider.pdf')
            ->setColor('warning')
            ->setActive(true);
        $manager->persist($document);

        $document = (new Download())
            ->setDocumentName('Dossier Médias')
            ->setFileName('feelarsen-dossier-medias.pdf')
            ->setColor('success')
            ->setActive(true);
        $manager->persist($document);

        $document = (new Download())
            ->setDocumentName('Dossier Complet')
            ->setFileName('feelarsen-dossier-complet.pdf')
            ->setColor('danger')
            ->setActive(true);
        $manager->persist($document);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 7;
    }
}
