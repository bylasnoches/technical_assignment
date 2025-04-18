<?php

namespace App\Application\Services\CryptoCurrency;

interface CryptoRateUpdaterInterface
{
    public function updateRates(): void;
}
