<?php

namespace App\Infrastructure\Controller\CryptoCurrency;

use App\Application\Factory\CryptoCurrency\GetRateRequestDtoFactory;
use App\Application\Services\CryptoCurrency\GetRatesServiceInterface;
use App\Infrastructure\Normalizer\CryptoCurrency\CryptoRateCollectionNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RatesController extends AbstractController
{
    #[Route('/api/rates', name: 'rates', methods: ['GET'])]
    public function exchangeListing(
        Request $request,
        GetRateRequestDtoFactory $getRateRequestDtoFactory,
        GetRatesServiceInterface $getRatesService,
        CryptoRateCollectionNormalizer $normalizer,
    ): JsonResponse {
        try {
            $requestDto = $getRateRequestDtoFactory->fromRequest($request->query->all());
            $rates = $getRatesService->findRates($requestDto);

            return new JsonResponse($normalizer->normalize(
                $requestDto->baseCurrency,
                $requestDto->quoteCurrency,
                $rates,
            ));
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 422);
        }
    }
}
