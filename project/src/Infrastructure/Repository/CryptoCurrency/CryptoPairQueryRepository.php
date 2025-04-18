<?php

namespace App\Infrastructure\Repository\CryptoCurrency;

use App\Domain\Model\CryptoCurrency\CryptoPair;
use App\Domain\Repository\CryptoCurrency\CryptoPairQueryRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

readonly class CryptoPairQueryRepository implements CryptoPairQueryRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder()
            ->getQuery()
            ->getResult()
            ;
    }

    public function findById(int $id): ?CryptoPair
    {
        $qb = $this->createQueryBuilder();
        $qb->andWhere('p.identifier.id = :id')->setParameter('id', $id);

        return $qb
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    private function createQueryBuilder(): QueryBuilder
    {
        return $this->entityManager->createQueryBuilder()
            ->select('cp')
            ->from(CryptoPair::class, 'cp')
            ;
    }
}
