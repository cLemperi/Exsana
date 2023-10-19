<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\FormContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormContact[]    findAll()
 * @method FormContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormContact::class);
    }

    public function findNotArchived(): array
    {
        return $this->createQueryBuilder('m') // "m" est un alias pour "message"
            ->where('m.isArchived IS NULL OR m.isArchived = :isArchived')
            ->setParameter('isArchived', false)
            ->getQuery()
            ->getResult();
    }
}
