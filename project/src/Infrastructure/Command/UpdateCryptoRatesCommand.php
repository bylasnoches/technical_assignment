<?php

namespace App\Infrastructure\Command;

use App\Application\Services\CryptoCurrency\CryptoRateUpdaterInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:update-crypto-rates',
    description: 'Fetch cryptocurrency pairs and update their rates',
    hidden: false
)]
class UpdateCryptoRatesCommand extends Command
{
    public function __construct(
        private readonly CryptoRateUpdaterInterface $cryptoRateUpdater,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->cryptoRateUpdater->updateRates();

        return Command::SUCCESS;
    }
}
