<?php

namespace App\Domain\Model\CryptoCurrency;

use App\Domain\Api\CryptoCurrency\CryptoPairSnapshotInterface;
use App\Domain\Api\CryptoCurrency\CryptoPairInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class CryptoPair implements CryptoPairInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private string $baseCurrency;

    #[ORM\Column(length: 10)]
    private string $quoteCurrency;

    #[ORM\OneToMany(targetEntity: CryptoRate::class, mappedBy: 'pair')]
    private Collection $rates;

    public function __construct(
        string $baseCurrency,
        string $quoteCurrency,
        Collection $rates,
    ) {
        $this->baseCurrency = $baseCurrency;
        $this->quoteCurrency = $quoteCurrency;
        $this->rates = $rates;
    }

    public function makeSnapshot(): CryptoPairSnapshotInterface
    {
        return new CryptoPairSnapshot(
            $this->id,
            $this->baseCurrency,
            $this->quoteCurrency,
            $this->rates,
        );
    }
}
