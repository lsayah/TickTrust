<?php

namespace App\Repository;

use App\Entity\Intervention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class InterventionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Intervention::class);
    }

    /**
     * Find interventions by technician
     *
     * @param int $technicianId
     * @return Intervention[]
     */
    public function findByTechnician(int $technicianId): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.technician = :technicianId')
            ->setParameter('technicianId', $technicianId)
            ->getQuery()
            ->getResult();
    }

    /**
     * Find interventions by ticket
     *
     * @param int $ticketId
     * @return Intervention[]
     */
    public function findByTicket(int $ticketId): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.ticket = :ticketId')
            ->setParameter('ticketId', $ticketId)
            ->getQuery()
            ->getResult();
    }

    /**
     * Find interventions within a date range
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return Intervention[]
     */
    public function findByDateRange(\DateTime $startDate, \DateTime $endDate): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.createdAt >= :startDate')
            ->andWhere('i.createdAt <= :endDate')
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->getQuery()
            ->getResult();
    }

    // Ajoutez vos méthodes personnalisées ici
}