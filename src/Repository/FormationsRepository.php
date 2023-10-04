<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use App\Entity\Formations;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Formations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formations[]    findAll()
 * @method Formations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formations::class);
    }

    /**
     * @return Formations[]
     */
    /** @phpstan-ignore-next-line */
    public function findByUser(User $user): array
    {
        return $this->createQueryBuilder('f')/* @phpstan-ignore-line */
            ->innerJoin('f.users', 'u')
            ->where('u.id = :userId')
            ->setParameter('userId', $user->getId())
            ->getQuery()
            ->getResult();
    }
}
