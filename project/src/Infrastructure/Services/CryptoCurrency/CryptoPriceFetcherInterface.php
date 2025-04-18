<?php

namespace App\Infrastructure\Services\CryptoCurrency;

interface CryptoPriceFetcherInterface
{
    public function fetch(string $base, string $quote): array;
}
