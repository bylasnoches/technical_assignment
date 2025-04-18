<?php

namespace App\Domain\Api\CryptoCurrency;

interface CryptoRateInterface
{
    public function makeSnapshot(): CryptoRateSnapshotInterface;
}
