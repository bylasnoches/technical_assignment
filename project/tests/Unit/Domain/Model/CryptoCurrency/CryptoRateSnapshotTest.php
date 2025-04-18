<?php

namespace App\Tests\Unit\Domain\Model\CryptoCurrency;

use App\Domain\Model\CryptoCurrency\CryptoRateSnapshot;
use App\Domain\Api\CryptoCurrency\CryptoPairInterface;
use PHPUnit\Framework\TestCase;

class CryptoRateSnapshotTest extends TestCase
{
    public function testGetTimestamp(): void
    {
        $id = '1';
        $pair = $this->createMock(CryptoPairInterface::class);
        $rate = 123.45;
        $timestamp = new \DateTimeImmutable('2023-01-01 12:00:00');

        $snapshot = new CryptoRateSnapshot($id, $pair, $rate, $timestamp);

        $this->assertSame($timestamp, $snapshot->getTimestamp());
    }
}
