<?php

namespace App\Tests\Unit\Domain\Model\CryptoCurrency;

use App\Domain\Model\CryptoCurrency\CryptoPairSnapshot;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class CryptoPairSnapshotTest extends TestCase
{
    public function testCryptoPairSnapshot(): void
    {
        $id = 1;
        $baseCurrency = 'BTC';
        $quoteCurrency = 'USD';
        $rates = new ArrayCollection(['rate1', 'rate2']);

        $snapshot = new CryptoPairSnapshot($id, $baseCurrency, $quoteCurrency, $rates);

        $this->assertSame($id, $snapshot->getId());
        $this->assertSame($baseCurrency, $snapshot->getBaseCurrency());
        $this->assertSame($quoteCurrency, $snapshot->getQuoteCurrency());
        $this->assertSame($rates, $snapshot->getRates());
    }
}
