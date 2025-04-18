<?php

namespace App\Domain\Repository\CryptoCurrency;

use App\Domain\Api\CryptoCurrency\CryptoRateInterface;

interface CryptoRateCommandRepositoryInterface
{
    public function save(CryptoRateInterface $cryptoRate): void;
}
