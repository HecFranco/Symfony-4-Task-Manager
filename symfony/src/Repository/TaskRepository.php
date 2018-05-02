<?php
// src/Entity/TaskRepository.php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use App\Entity\Task;

class TaskRepository extends ServiceEntityRepository{
  public function __construct(RegistryInterface $registry) {
      parent::__construct($registry, Task::class);
  }
  public function searchingTask( $user_id, $search = null, $status = null, $order ) {
    $qb = $this->createQueryBuilder('t')
        ->innerJoin('t.user', 'u', 'u.id = t.user')
        ->where('u.id =:user_id')
        ->setParameter('user_id', $user_id);
    if( $status != null ){
      $qb = $qb->andWhere('t.status =:status')
        ->setParameter('status', $status);
    }
    if( $search != null ){
      $qb = $qb->andWhere('t.title LIKE :search OR t.description LIKE :search')
        ->setParameter('search', '%'.$search.'%');
    }    
    $qb = $qb->orderBy('t.id', $order);
    $searchingTask  = $qb->getQuery()->execute();
    return $searchingTask;
  }
}