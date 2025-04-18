<?php

namespace App\Infrastructure\Repository\CryptoCurrency;

use App\Domain\Api\CryptoCurrency\CryptoPairInterface;
use App\Domain\Repository\CryptoCurrency\CryptoPairCommandRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

readonly class CryptoPairCommandRepository implements CryptoPairCommandRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function save(CryptoPairInterface $cryptoPair): void
    {
        $this->entityManager->persist($cryptoPair);
        $this->entityManager->flush();
    }
}
