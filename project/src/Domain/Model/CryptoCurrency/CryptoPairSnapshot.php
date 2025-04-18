<?php

namespace App\Domain\Model\CryptoCurrency;

use App\Domain\Api\CryptoCurrency\CryptoPairSnapshotInterface;
use Doctrine\Common\Collections\Collection;

readonly class CryptoPairSnapshot implements CryptoPairSnapshotInterface
{
    public function __construct(
        private ?int $id,
        private string $baseCurrency,
        private string $quoteCurrency,
        private Collection $rates,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    public function getQuoteCurrency(): string
    {
        return $this->quoteCurrency;
    }

    public function getRates(): Collection
    {
        return $this->rates;
    }
}
