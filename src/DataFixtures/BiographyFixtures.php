<?php

namespace App\DataFixtures;

use App\Entity\Biography;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BiographyFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $biography = (new Biography())
            ->setContent("<strong>Féelarsen</strong> est un groupe de rock basé à <strong>Limoges</strong>. Dès ses débuts, le groupe s'est imposé avec un style de rock pur, énergique et sans compromis, qui puise ses influences dans des groupes emblématiques du <strong>rock français</strong> tels que <strong>Noir Désir</strong>, <strong>Starshooter</strong>, les <strong>Wampas</strong>. Le groupe se distingue par ses compositions originales, toutes en français, qui abordent des thèmes à la fois sombres et ironiques, avec une touche mordante dans les paroles.")
            ->setPhoto('biography-1.jpg')
            ->setPosition(1)
            ->setActive(true);
        $manager->persist($biography);

        $biography = (new Biography())
            ->setContent("Le premier EP du groupe, intitulé &laquo;&nbsp;J'ai un dragon à la maison&nbsp;&raquo;, est sorti en mars 2015. Cet album témoigne de la <strong>diversité</strong> thématique du groupe, oscillant entre des sujets graves comme dans &laquo;&nbsp;Sous les décombres&nbsp;&raquo; et des caricatures de la <strong>société contemporaine</strong>. Les morceaux du groupe se caractérisent par des guitares acérées, une rythmique impeccable et des textes <strong>critiques</strong>, souvent empreints d'un esprit satyrique.")
            ->setPhoto('biography-2.jpg')
            ->setPosition(2)
            ->setActive(true);
        $manager->persist($biography);

        $biography = (new Biography())
            ->setContent("Féelarsen s'est fait un nom sur la scène locale en se produisant principalement dans des bars et en partageant la scène avec d'autres groupes lors de festivals et de tremplins musicaux. Le groupe a également assuré les premières parties d'artistes comme <strong>HK et les Saltimbanks</strong>, <strong>Les Ramoneurs de Menhirs</strong>, <strong>Les Sales Majestés</strong>, <strong>Krav Boca</strong>, renforçant ainsi leur réputation de groupe taillé pour la scène. Leur énergie débordante et leur style musical <strong>franchement énervé</strong> les rendent incontournables pour les amateurs de <strong>rock alternatif</strong>.")
            ->setPhoto('biography-3.jpg')
            ->setPosition(3)
            ->setActive(true);
        $manager->persist($biography);

        $biography = (new Biography())
            ->setContent("En 2022, Féelarsen a sorti un EP intitulé &laquo;&nbsp;Willy&nbsp;&raquo;, qui a marqué une nouvelle étape dans leur progression. Cet opus a poursuivi l'exploration de sonorités rock puissantes, tout en maintenant une critique sociale acerbe, confirmant ainsi leur engagement à ne pas laisser le <strong>rock français</strong> tomber dans l'oubli. Le succès de cet EP les a encouragés à continuer sur cette lancée.")
            ->setPhoto('biography-4.jpg')
            ->setPosition(4)
            ->setActive(true);
        $manager->persist($biography);

        $biography = (new Biography())
            ->setContent("En 2024, le groupe a franchi une nouvelle étape avec la sortie de leur troisième EP, &laquo;&nbsp;Atomic Cowboy&nbsp;&raquo;. Cet album, qui reflète l'évolution musicale du groupe, mêle des riffs de guitare encore plus acérés avec des paroles incisives, témoignant de leur maturité et de leur capacité à se réinventer tout en restant fidèles à leurs racines rock. Atomic Cowboy a reçu un accueil chaleureux, consolidant la place de <strong>Féelarsen</strong> sur la <strong>scène rock française</strong> et ouvrant la voie à de nouvelles opportunités pour le groupe dans les années à venir.")
            ->setPhoto('biography-5.jpg')
            ->setPosition(5)
            ->setActive(true);
        $manager->persist($biography);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 5;
    }
}
