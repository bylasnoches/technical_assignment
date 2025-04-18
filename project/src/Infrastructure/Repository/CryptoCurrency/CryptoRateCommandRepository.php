<?php

namespace App\Infrastructure\Repository\CryptoCurrency;

use App\Domain\Api\CryptoCurrency\CryptoRateInterface;
use App\Domain\Repository\CryptoCurrency\CryptoRateCommandRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

readonly class CryptoRateCommandRepository implements CryptoRateCommandRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function save(CryptoRateInterface $cryptoRate): void
    {
        $this->entityManager->persist($cryptoRate);
        $this->entityManager->flush();
    }
}
