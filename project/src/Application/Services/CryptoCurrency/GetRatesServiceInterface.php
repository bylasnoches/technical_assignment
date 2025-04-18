<?php

namespace App\Application\Services\CryptoCurrency;

use App\Application\Dto\CryptoCurrency\GetRateRequestDto;

interface GetRatesServiceInterface
{
    public function findRates(GetRateRequestDto $dto): array;
}
