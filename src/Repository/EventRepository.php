<?php

namespace App\Repository;

use App\Entity\Calendar;
use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function findAllMonths(Calendar $calendar): array
    {
        $qb = $this->createQueryBuilder('e')
            ->innerJoin('e.calendar', 'c')
            ->where('c = :calendar')
            ->setParameter('calendar', $calendar)
            ->select('DISTINCT e.startAt')
            ->orderBy('e.startAt', 'ASC');

        $results = $qb->getQuery()->getResult();

        $months = [];
        foreach($results as $result) {
            if($result['startAt'] instanceof \DateTimeImmutable) {
                $monthYear = $result['startAt']->format('Y-m');
                if(!in_array($monthYear, $months, true)) {
                    $months[] = $monthYear;
                }
            }
        }

        return array_map(function($monthYear) {
            return (int)substr($monthYear, 5, 2);
        }, $months);
    }

    public function findAllCities(Calendar $calendar): array
    {
        $qb = $this->createQueryBuilder('e')
            ->innerJoin('e.calendar', 'c')
            ->where('c = :calendar')
            ->setParameter('calendar', $calendar)
            ->select('DISTINCT e.city')
            ->andWhere('e.city IS NOT NULL')
            ->orderBy('e.city', 'ASC');

        $results = $qb->getQuery()->getResult();

        return array_column($results, 'city');
    }

    public function findAllDepartments(Calendar $calendar): array
    {
        $qb = $this->createQueryBuilder('e')
            ->innerJoin('e.calendar', 'c')
            ->where('c = :calendar')
            ->setParameter('calendar', $calendar)
            ->select('DISTINCT e.department')
            ->andWhere('e.department IS NOT NULL')
            ->orderBy('e.department', 'ASC');

        $results = $qb->getQuery()->getResult();

        return array_column($results, 'department');
    }

    public function findEventsByFilters(int $calendarId, ?string $month = null, ?string $city = null, ?string $department = null): array
    {
        $qb = $this->createQueryBuilder('e')
            ->innerJoin('e.calendar', 'c')
            ->where('c.id = :calendarId')
            ->setParameter('calendarId', $calendarId);

        if($month) {
            $year = (new \DateTimeImmutable())->format('Y');
            $startDate = new \DateTimeImmutable("$year-$month-01");
            $endDate = $startDate->modify('last day of this month')->setTime(23, 59, 59);

            $qb->andWhere('e.startAt BETWEEN :startDate AND :endDate')
                ->setParameter('startDate', $startDate)
                ->setParameter('endDate', $endDate);
        }

        if($city) {
            $qb->andWhere('e.city = :city')
                ->setParameter('city', $city);
        }

        if($department) {
            $qb->andWhere('e.department = :department')
                ->setParameter('department', $department);
        }

        $qb->orderBy('e.startAt', 'ASC');

        return $qb->getQuery()->getResult();
    }
}
