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
            ->setDocumentName('Dossier de Présentation')
            ->setFileName('feelarsen-dossier-de-presentation.pdf')
            ->setColor('success')
            ->setActive(true);
        $manager->persist($document);

        $document = (new Download())
            ->setDocumentName('Dossier Technique')
            ->setFileName('feelarsen-dossier-technique.pdf')
            ->setColor('info')
            ->setActive(false);
        $manager->persist($document);

        $document = (new Download())
            ->setDocumentName('Rider')
            ->setFileName('feelarsen-rider.pdf')
            ->setColor('warning')
            ->setActive(false);
        $manager->persist($document);

        $document = (new Download())
            ->setDocumentName('Dossier Médias')
            ->setFileName('feelarsen-dossier-medias.pdf')
            ->setColor('success')
            ->setActive(false);
        $manager->persist($document);

        $document = (new Download())
            ->setDocumentName('Dossier Général')
            ->setFileName('feelarsen-dossier-general.pdf')
            ->setColor('danger')
            ->setActive(false);
        $manager->persist($document);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 7;
    }
}
