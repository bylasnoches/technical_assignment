<?php

namespace App\Domain\Model\CryptoCurrency;

use App\Domain\Api\CryptoCurrency\CryptoPairInterface;
use App\Domain\Api\CryptoCurrency\CryptoRateInterface;
use App\Domain\Api\CryptoCurrency\CryptoRateSnapshotInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class CryptoRate implements CryptoRateInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: CryptoPair::class, inversedBy: 'rates')]
    #[ORM\JoinColumn(nullable: false)]
    private CryptoPairInterface $pair;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 8)]
    private string $rate;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    public function __construct(
        CryptoPairInterface $pair,
        string $rate,
        \DateTimeImmutable $createdAt,
    ) {
        $this->pair = $pair;
        $this->rate = $rate;
        $this->createdAt = $createdAt;
    }

    public function makeSnapshot(): CryptoRateSnapshotInterface
    {
        return new CryptoRateSnapshot(
            $this->id,
            $this->pair,
            $this->rate,
            $this->createdAt,
        );
    }
}
