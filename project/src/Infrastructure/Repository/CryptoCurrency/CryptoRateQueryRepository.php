<?php

namespace App\Infrastructure\Repository\CryptoCurrency;

use App\Domain\Model\CryptoCurrency\CryptoRate;
use App\Domain\Repository\CryptoCurrency\CryptoRateQueryRepositoryInterface;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

readonly class CryptoRateQueryRepository implements CryptoRateQueryRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function findRates(string $base, string $quote, ?DateTimeInterface $from, ?DateTimeInterface $to): array
    {
        $qb = $this->createQueryBuilder();
        $qb->join('cr.pair', 'cp')
            ->andWhere('cp.baseCurrency = :base')
            ->andWhere('cp.quoteCurrency = :quote')
            ->setParameter('base', $base)
            ->setParameter('quote', $quote);

        if ($from !== null) {
            $qb->andWhere('cr.createdAt >= :from')
                ->setParameter('from', $from);
        }

        if ($to !== null) {
            $qb->andWhere('cr.createdAt <= :to')
                ->setParameter('to', $to);
        }

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    private function createQueryBuilder(): QueryBuilder
    {
        return $this->entityManager->createQueryBuilder()
            ->select('cr')
            ->from(CryptoRate::class, 'cr')
            ;
    }
}
