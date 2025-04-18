<?php

namespace App\Domain\Repository\CryptoCurrency;

use App\Domain\Api\CryptoCurrency\CryptoPairInterface;

interface CryptoPairCommandRepositoryInterface
{
    public function save(CryptoPairInterface $cryptoPair): void;
}
