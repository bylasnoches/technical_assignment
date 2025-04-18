<?php

namespace App\Application\Factory\CryptoCurrency;

use App\Application\Dto\CryptoCurrency\GetRateRequestDto;

class GetRateRequestDtoFactory
{
    public function fromRequest(array $data): GetRateRequestDto
    {
        $base = $data['baseCurrency'] ? strtoupper($data['baseCurrency']) : null;
        $quote = $data['quoteCurrency'] ? strtoupper($data['quoteCurrency']) : null;
        $from = $data['from'] ?? null;
        $to = $data['to'] ?? null;

        if (!$base || !$quote) {
            throw new \InvalidArgumentException('baseCurrency and quoteCurrency are required');
        }

        $fromDt = null;
        $toDt = null;

        if (!empty($from) && $from !== '') {
            $this->isTimeValid($from);
            $fromDt = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s.u', $from);
        }

        if (!empty($to) && $to !== '') {
            $this->isTimeValid($to);
            $toDt = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s.u', $to);
        }

        return new GetRateRequestDto(
            $base,
            $quote,
            $fromDt,
            $toDt,
        );
    }

    // TODO: move this to a validator
    private function isTimeValid(string $time): void
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d{6}$/', $time)) {
            throw new \InvalidArgumentException('Invalid datetime format. Expected: Y-m-d H:i:s.u');
        }
    }
}
