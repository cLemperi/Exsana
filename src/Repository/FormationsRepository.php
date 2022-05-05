<?php
declare(strict_types=1);
namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Formations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
     * récupère les formations en lien avec une recherche
     * @return Formation[]
     */
    public function findSearch(SearchData $search): array{
        $query =$this
        ->createQueryBuilder('f')
        ->select('c','f')
        ->join('f.category','c');

        if (!empty($search->q)){
            $query = $query
            ->andWhere('f.name LIKE:q')
            ->setParameter('q', "%{$search->q}%");
        }
        return $query->getQuery()->getResult();
        
    }

    
}
