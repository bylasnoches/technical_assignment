<?php

namespace App\Domain\Model\CryptoCurrency;

use App\Domain\Api\CryptoCurrency\CryptoPairInterface;
use App\Domain\Api\CryptoCurrency\CryptoRateSnapshotInterface;

readonly class CryptoRateSnapshot implements CryptoRateSnapshotInterface
{
    public function __construct(
        private string $id,
        private CryptoPairInterface $pair,
        private float $rate,
        private \DateTimeImmutable $timestamp,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPair(): CryptoPairInterface
    {
        return $this->pair;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getTimestamp(): \DateTimeImmutable
    {
        return $this->timestamp;
    }
}
