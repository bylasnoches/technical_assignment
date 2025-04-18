<?php

namespace App\Domain\Api\CryptoCurrency;

use Doctrine\Common\Collections\Collection;

interface CryptoPairSnapshotInterface
{
    public function getId(): ?int;

    public function getBaseCurrency(): string;

    public function getQuoteCurrency(): string;

    public function getRates(): Collection;
}
