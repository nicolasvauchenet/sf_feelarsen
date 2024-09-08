<?php

namespace App\Repository;

use App\Entity\Biography;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Biography>
 */
class BiographyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Biography::class);
    }

    public function addBiography(Biography $biography): void
    {
        $maxPosition = $this->createQueryBuilder('b')
            ->select('MAX(b.position)')
            ->getQuery()
            ->getSingleScalarResult();

        $newPosition = $maxPosition ? $maxPosition + 1 : 1;
        $biography->setPosition($newPosition);
        $this->getEntityManager()->persist($biography);
        $this->getEntityManager()->flush();
    }

    public function deleteBiography(Biography $biography): void
    {
        $this->getEntityManager()->remove($biography);
        $this->getEntityManager()->flush();

        $biographies = $this->createQueryBuilder('b')
            ->orderBy('b.position', 'ASC')
            ->getQuery()
            ->getResult();

        foreach($biographies as $index => $remainingBiography) {
            $remainingBiography->setPosition($index + 1);
            $this->getEntityManager()->persist($remainingBiography);
        }

        $this->getEntityManager()->flush();
    }

    public function resetPositions(Biography $updatedBiography): void
    {
        $biographies = $this->createQueryBuilder('b')
            ->where('b.id != :id')
            ->setParameter('id', $updatedBiography->getId())
            ->orderBy('b.position', 'ASC')
            ->getQuery()
            ->getResult();

        $newPosition = $updatedBiography->getPosition();
        $currentIndex = 1;

        foreach($biographies as $biography) {
            if($currentIndex == $newPosition) {
                $updatedBiography->setPosition($currentIndex);
                $this->getEntityManager()->persist($updatedBiography);
                $currentIndex++;
            }
            $biography->setPosition($currentIndex);
            $this->getEntityManager()->persist($biography);
            $currentIndex++;
        }

        if($newPosition >= $currentIndex) {
            $updatedBiography->setPosition($currentIndex);
            $this->getEntityManager()->persist($updatedBiography);
        }

        $this->getEntityManager()->flush();
    }
}
