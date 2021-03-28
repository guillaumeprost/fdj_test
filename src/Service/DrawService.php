<?php

namespace App\Service;

use App\Entity\Draw;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

/**
 * Logic about draws
 *
 * Class DrawService
 * @package App\Service
 *
 */
class DrawService
{
    const DRAW_API = 'https://www.fdj.fr/api/service-draws/v1/games/euromillions/draws';

    /** @var HttpClientInterface */
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Récupère le dernier tirage
     *
     * @return array
     *
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function getLastDraw(): array
    {
        $filters = ['range' => '0-0'];

        return $this->retrieveDraws($filters);
    }

    /**
     * Récupère les tirages depuis l'api en fonction des filtres
     *
     * @param array $filters
     * @return mixed
     *
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function retrieveDraws(array $filters): array
    {
        $serializer = new Serializer([
            new GetSetMethodNormalizer(null, new CamelCaseToSnakeCaseNameConverter()),
            new ArrayDenormalizer()
        ], [new JsonEncoder()]);

        $queryParameters = [
            'include' => "results,addons"
        ];

        if (isset($filters['range'])){
            $queryParameters['range'] = $filters['range'];
        }

        $response = $this->client->request('GET', self::DRAW_API, [
            'query' => $queryParameters
        ]);

        return $serializer->deserialize($response->getContent(), Draw::class.'[]', 'json');
    }
}