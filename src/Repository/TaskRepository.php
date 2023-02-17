<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method MyEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyEntity[]    findAll()
 * @method MyEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function add(Task $entity, bool $flush = false):void 
    {
        $this->getEntityManager()->persist($entity);

        if ($flush){
            $this->getEntityManager()->flush();
        }
    }


    public function remove(Task $entity, bool $flush = false):void 
    {
        $this->getEntityManager()->remove($entity);

        if ($flush){
            $this->getEntityManager()->flush();
        }
    }


    public function toggle(Task $task, bool $flush = false):void 
    {
        $task->toggle(!$task->isDone());

        $this->getEntityManager()->persist($task);

        if ($flush){
            $this->getEntityManager()->flush();
        }

    }
    // /**
    //  * @return MyEntity[] Returns an array of MyEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MyEntity
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}