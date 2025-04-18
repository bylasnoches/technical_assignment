<?php

namespace App\Infrastructure\DataFixtures;

use App\Application\Factory\CryptoCurrency\CryptoPairFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

class CryptoPairFixtures extends Fixture
{
    public function __construct(
        private readonly CryptoPairFactory $cryptoPairFactory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $data = [
            ['BTC', 'USD'],
            ['ETH', 'USD'],
            ['SOL', 'USD'],
        ];

        foreach ($data as [$baseCurrency, $quoteCurrency]) {
            $cryptoPair = $this->cryptoPairFactory->create(
                $baseCurrency,
                $quoteCurrency,
                new ArrayCollection()
            );
            $manager->persist($cryptoPair);
        }
        $manager->flush();
    }
}
