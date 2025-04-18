<?php

namespace App\Domain\Repository\CryptoCurrency;

use App\Domain\Api\CryptoCurrency\CryptoPairInterface;

interface CryptoPairQueryRepositoryInterface
{
    public function findAll(): array;

    public function findById(int $id): ?CryptoPairInterface;
}
