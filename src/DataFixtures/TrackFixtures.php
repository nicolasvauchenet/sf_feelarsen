<?php

namespace App\DataFixtures;

use App\Entity\Track;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TrackFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // En Attendant
        $track = (new Track())
            ->setPosition(1)
            ->setTitle('Cet enfer')
            ->setFileName('cet-enfer.mp3')
            ->setAlbum($this->getReference('album-en-attendant'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(2)
            ->setTitle('Dans quelques heures')
            ->setFileName('dans-quelques-heures.mp3')
            ->setAlbum($this->getReference('album-en-attendant'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(3)
            ->setTitle('Sans moi')
            ->setFileName('sans-moi.mp3')
            ->setAlbum($this->getReference('album-en-attendant'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(4)
            ->setTitle('En attendant')
            ->setFileName('en-attendant.mp3')
            ->setAlbum($this->getReference('album-en-attendant'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(5)
            ->setTitle("Le royaume de la com'")
            ->setFileName('le-royaume-de-la-com.mp3')
            ->setAlbum($this->getReference('album-en-attendant'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(6)
            ->setTitle("Trop d'années")
            ->setFileName('trop-dannees.mp3')
            ->setAlbum($this->getReference('album-en-attendant'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(7)
            ->setTitle('Habiter la France')
            ->setFileName('habiter-la-france.mp3')
            ->setAlbum($this->getReference('album-en-attendant'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(8)
            ->setTitle('De 140 à 220')
            ->setFileName('de-140-a-220.mp3')
            ->setAlbum($this->getReference('album-en-attendant'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(9)
            ->setTitle('Star 2000')
            ->setFileName('star-2000.mp3')
            ->setAlbum($this->getReference('album-en-attendant'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(10)
            ->setTitle("Y'a un cauchemar")
            ->setFileName('ya-un-cauchemar.mp3')
            ->setAlbum($this->getReference('album-en-attendant'))
            ->setActive(true);
        $manager->persist($track);

        // J'ai un dragon à la maison
        $track = (new Track())
            ->setPosition(1)
            ->setTitle("Quoi d'neuf ?")
            ->setFileName('quoi-dneuf.mp3')
            ->setAlbum($this->getReference('album-jai-un-dragon-a-la-maison'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(2)
            ->setTitle('Nos militants')
            ->setFileName('nos-militants.mp3')
            ->setAlbum($this->getReference('album-jai-un-dragon-a-la-maison'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(3)
            ->setTitle("J'ai un dragon à la maison")
            ->setFileName('jai-un-dragon-a-la-maison.mp3')
            ->setAlbum($this->getReference('album-jai-un-dragon-a-la-maison'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(4)
            ->setTitle('Sous les décombres')
            ->setFileName('sous-les-decombres.mp3')
            ->setAlbum($this->getReference('album-jai-un-dragon-a-la-maison'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(5)
            ->setTitle('Volontaires')
            ->setFileName('volontaires.mp3')
            ->setAlbum($this->getReference('album-jai-un-dragon-a-la-maison'))
            ->setActive(true);
        $manager->persist($track);

        // Willy
        $track = (new Track())
            ->setPosition(1)
            ->setTitle('Willy mon coq à moi')
            ->setFileName('willy-mon-coq-a-moi.mp3')
            ->setAlbum($this->getReference('album-willy'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(2)
            ->setTitle("Ton ch'val dans mon verre")
            ->setFileName('ton-chval-dans-mon-verre.mp3')
            ->setAlbum($this->getReference('album-willy'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(3)
            ->setTitle('Vaisseau Volvo')
            ->setFileName('vaisseau-volvo.mp3')
            ->setAlbum($this->getReference('album-willy'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(4)
            ->setTitle('Mon héroïne')
            ->setFileName('mon-heroine.mp3')
            ->setAlbum($this->getReference('album-willy'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(5)
            ->setTitle('Par les routes')
            ->setFileName('par-les-routes.mp3')
            ->setAlbum($this->getReference('album-willy'))
            ->setActive(true);
        $manager->persist($track);

        // Atomic Cowboy
        $track = (new Track())
            ->setPosition(1)
            ->setTitle('Atomic Cowboy Acte 1')
            ->setFileName('atomic-cowboy-acte-1.mp3')
            ->setAlbum($this->getReference('album-atomic-cowboy'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(2)
            ->setTitle('Atomic Cowboy Acte 2')
            ->setFileName('atomic-cowboy-acte-2.mp3')
            ->setAlbum($this->getReference('album-atomic-cowboy'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(3)
            ->setTitle('Ce qui nous tient')
            ->setFileName('ce-qui-nous-tient.mp3')
            ->setAlbum($this->getReference('album-atomic-cowboy'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(4)
            ->setTitle('Quadragénaire')
            ->setFileName('quadragenaire.mp3')
            ->setAlbum($this->getReference('album-atomic-cowboy'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(5)
            ->setTitle('Idées sales')
            ->setFileName('idees-sales.mp3')
            ->setAlbum($this->getReference('album-atomic-cowboy'))
            ->setActive(true);
        $manager->persist($track);

        // Live à Oléron
        $track = (new Track())
            ->setPosition(1)
            ->setTitle('Atomic Cowboy Acte 1')
            ->setFileName('atomic-cowboy-acte-1.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(2)
            ->setTitle('Atomic Cowboy Acte 2')
            ->setFileName('atomic-cowboy-acte-2.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(3)
            ->setTitle('Volontaire')
            ->setFileName('volontaire.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(4)
            ->setTitle('Ce qui nous tient')
            ->setFileName('ce-qui-nous-tient.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(5)
            ->setTitle('Idées sales')
            ->setFileName('idees-sales.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(6)
            ->setTitle('Quadragénaire')
            ->setFileName('quadragenaire.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(7)
            ->setTitle('Willy')
            ->setFileName('willy.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(8)
            ->setTitle("L'attente")
            ->setFileName('lattente.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(9)
            ->setTitle('Sa mère la chienne')
            ->setFileName('sa-mere-la-chienne.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(10)
            ->setTitle('Vaisseau Volvo')
            ->setFileName('vaisseau-volvo.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(11)
            ->setTitle('Mon héroïne')
            ->setFileName('mon-heroine.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(12)
            ->setTitle("Ton ch'val dans mon verre")
            ->setFileName('ton-chval-dans-mon-verre.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(13)
            ->setTitle('En attendant')
            ->setFileName('en-attendant.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(14)
            ->setTitle('De 140 à 220')
            ->setFileName('de-140-a-220.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(15)
            ->setTitle('Par les routes')
            ->setFileName('par-les-routes.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(16)
            ->setTitle('Star 2000')
            ->setFileName('star-2000.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(17)
            ->setTitle("J'ai un dragon à la maison")
            ->setFileName('jai-un-dragon-a-la-maison.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $track = (new Track())
            ->setPosition(18)
            ->setTitle('Sous les décombres')
            ->setFileName('sous-les-decombres.mp3')
            ->setAlbum($this->getReference('album-live-a-oleron'))
            ->setActive(true);
        $manager->persist($track);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 8;
    }
}
