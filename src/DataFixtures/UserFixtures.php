<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@bastardsoundsystem.org')
            ->setPassword($this->passwordHasher->hashPassword($user, '!bEb7RgDFJM?'))
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 11;
    }
}
