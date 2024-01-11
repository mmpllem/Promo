<?php

namespace App\Application\Repository;

use App\Domain\Entity\TestJson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestJson>
 *
 * @method TestJson|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestJson|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestJson[]    findAll()
 * @method TestJson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestJsonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestJson::class);
    }

//    /**
//     * @return TestJson[] Returns an array of TestJson objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TestJson
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
