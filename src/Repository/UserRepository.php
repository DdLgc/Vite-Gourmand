<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    public function findEmployees(): array
{
    $connection = $this->getEntityManager()->getConnection();

    $ids = $connection->fetchFirstColumn(
        <<<SQL
            SELECT id
            FROM app_user
            WHERE roles::jsonb @> :role::jsonb
            ORDER BY last_name ASC, first_name ASC
        SQL,
        ['role' => '["ROLE_EMPLOYEE"]']
    );

    if ($ids === []) {
        return [];
    }

    $employees = $this->findBy(['id' => $ids]);

    // Conserve l'ordre alphabétique.
    usort($employees, static function (User $a, User $b): int {
        return [$a->getLastName(), $a->getFirstName()]
            <=> [$b->getLastName(), $b->getFirstName()];
    });

    return $employees;
}

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
