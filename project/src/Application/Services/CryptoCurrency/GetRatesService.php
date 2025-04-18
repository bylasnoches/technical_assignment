<?php

namespace App\Application\Services\CryptoCurrency;

use App\Application\Dto\CryptoCurrency\GetRateRequestDto;
use App\Domain\Repository\CryptoCurrency\CryptoRateQueryRepositoryInterface;

readonly class GetRatesService implements GetRatesServiceInterface
{
    public function __construct(
        private CryptoRateQueryRepositoryInterface $rateRepository,
    ) {
    }

    public function findRates(GetRateRequestDto $dto): array
    {
        return $this->rateRepository->findRates(
            $dto->baseCurrency,
            $dto->quoteCurrency,
            $dto->from,
            $dto->to
        );
    }
}
