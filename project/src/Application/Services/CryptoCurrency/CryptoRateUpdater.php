<?php

namespace App\Application\Services\CryptoCurrency;

use App\Application\Factory\CryptoCurrency\CryptoRateFactory;
use App\Domain\Model\CryptoCurrency\CryptoPair;
use App\Domain\Repository\CryptoCurrency\CryptoPairQueryRepositoryInterface;
use App\Domain\Repository\CryptoCurrency\CryptoRateCommandRepositoryInterface;
use App\Infrastructure\Services\CryptoCurrency\CryptoPriceFetcher;
use Psr\Log\LoggerInterface;

readonly class CryptoRateUpdater implements CryptoRateUpdaterInterface
{
    public function __construct(
        private CryptoPairQueryRepositoryInterface $cryptoPairQueryRepository,
        private CryptoRateCommandRepositoryInterface $cryptoRateCommandRepository,
        private CryptoPriceFetcher $fetcher,
        private CryptoRateFactory $cryptoRateFactory,
        private LoggerInterface $logger,
    ) {
    }

    public function updateRates(): void
    {
        foreach ($this->cryptoPairQueryRepository->findAll() as $pair) {
            /** @var CryptoPair $pair */
            $pairSnapshot = $pair->makeSnapshot();

            try {
                $response = $this->fetcher->fetch($pairSnapshot->getBaseCurrency(), $pairSnapshot->getQuoteCurrency());
            } catch (\Exception) {
                $this->logger->error('Error fetching crypto price', [
                    'baseCurrency' => $pairSnapshot->getBaseCurrency(),
                    'quoteCurrency' => $pairSnapshot->getQuoteCurrency(),
                ]);
                continue;
            }

            $data = $response['data'][$pairSnapshot->getBaseCurrency()] ?? null;

            if ($data === null) {
                $this->logger->error('Invalid response from crypto price fetcher', [
                    'baseCurrency' => $pairSnapshot->getBaseCurrency(),
                    'quoteCurrency' => $pairSnapshot->getQuoteCurrency(),
                ]);
                continue;
            }

            if (array_key_exists($pairSnapshot->getQuoteCurrency(), $data['quote'])) {
                $cryptoRate = $this->cryptoRateFactory->create(
                    $pair,
                    $data['quote'][$pairSnapshot->getQuoteCurrency()]['price'],
                    new \DateTimeImmutable()
                );

                $this->cryptoRateCommandRepository->save($cryptoRate);
            }
        }
    }
}
