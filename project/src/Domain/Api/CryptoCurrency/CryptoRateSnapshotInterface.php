<?php

namespace App\Domain\Api\CryptoCurrency;

use DateTimeInterface;

interface CryptoRateSnapshotInterface
{
    public function getId(): string;

    public function getPair(): CryptoPairInterface;

    public function getRate(): float;

    public function getTimestamp(): DateTimeInterface;
}
