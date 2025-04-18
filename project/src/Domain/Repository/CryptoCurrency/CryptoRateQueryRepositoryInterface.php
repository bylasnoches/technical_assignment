<?php

namespace App\Domain\Repository\CryptoCurrency;

use DateTimeInterface;

interface CryptoRateQueryRepositoryInterface
{
    public function findRates(string $base, string $quote, ?DateTimeInterface $from, ?DateTimeInterface $to): array;
}
