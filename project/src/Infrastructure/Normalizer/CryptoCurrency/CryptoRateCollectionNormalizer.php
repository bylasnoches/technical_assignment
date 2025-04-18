<?php

namespace App\Infrastructure\Normalizer\CryptoCurrency;

use App\Domain\Model\CryptoCurrency\CryptoRate;

class CryptoRateCollectionNormalizer
{
    /**
     * @param CryptoRate[] $rates
     */
    public function normalize(string $base, string $quote, array $rates): array
    {
        $data = array_map(function (CryptoRate $rate) {
            return [
                'price' => $rate->makeSnapshot()->getRate(),
                'timestamp' => $rate->makeSnapshot()->getTimestamp(),
            ];
        }, $rates);

        return [
            'baseCurrency' => $base,
            'quoteCurrency' => $quote,
            'data' => $data,
        ];
    }
}
