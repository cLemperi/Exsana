<?php
declare(strict_types=1);
namespace App\Repository;

use App\Entity\User;
use App\Data\SearchData;
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

    public function findByUser(User $user)
    {
        return $this->createQueryBuilder('f')
            ->innerJoin('f.users', 'u')
            ->where('u.id = :userId')
            ->setParameter('userId', $user->getId())
            ->getQuery()
            ->getResult();
    }   



    /**
     * récupère les formations en lien avec une recherche
     * @return Formation[]
     */

   /* public function findSearch(SearchData $search): array{
        $query =$this
        ->createQueryBuilder('f')
        ->select('c','f')
        ->join('f.category','c');

        if (!empty($search->q) && (isset($search->q))){
            $query = $query
            ->andWhere('f.name LIKE:q')
            ->setParameter('q', "%{$search->q}%");
        }
        return $query->getQuery()->getResult();

    }

*/
}
