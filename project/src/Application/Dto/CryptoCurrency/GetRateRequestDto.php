<?php

namespace App\Application\Dto\CryptoCurrency;

use DateTimeInterface;

class GetRateRequestDto
{
    public function __construct(
        public string $baseCurrency,
        public string $quoteCurrency,
        public ?DateTimeInterface $from = null,
        public ?DateTimeInterface $to = null,
    ) {
    }
}
