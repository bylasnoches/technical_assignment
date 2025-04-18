<?php

namespace App\Domain\Api\CryptoCurrency;

interface CryptoPairInterface
{
    public function makeSnapshot(): CryptoPairSnapshotInterface;
}
