<?php

namespace App\Application\Factory\CryptoCurrency;

use App\Domain\Api\CryptoCurrency\CryptoPairInterface;
use App\Domain\Model\CryptoCurrency\CryptoPair;
use Doctrine\Common\Collections\Collection;

class CryptoPairFactory
{
    public function create(
        string $baseCurrency,
        string $quoteCurrency,
        Collection $rates,
    ): CryptoPairInterface {
        return new CryptoPair($baseCurrency, $quoteCurrency, $rates);
    }
}
