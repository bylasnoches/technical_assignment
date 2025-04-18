<?php

namespace App\Application\Factory\CryptoCurrency;

use App\Domain\Api\CryptoCurrency\CryptoPairInterface;
use App\Domain\Api\CryptoCurrency\CryptoRateInterface;
use App\Domain\Model\CryptoCurrency\CryptoRate;
use DateTimeInterface;

class CryptoRateFactory
{
    public function create(
        CryptoPairInterface $pair,
        string $rate,
        DateTimeInterface $createdAt,
    ): CryptoRateInterface {
        return new CryptoRate($pair, $rate, $createdAt);
    }
}
