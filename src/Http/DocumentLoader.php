<?php

namespace Jolicode\JsonLd\Http;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DocumentLoader
{
    public function __construct(
        private string $url,
        private bool $extractAllScripts = false,
        private ?string $profile = null,
        private null|string|array $requestProfile = null,
        private HttpClientInterface $httpClient,
    ) {
        $this->httpClient = HttpClient::create();
    }

    public function loadDocument()
    {
        $document = $this->httpClient->request(
            'GET',
            $this->url,
            [
                'headers' => [
                    'Accept' => 'application/ld+json,application/json,*/*;q=0.1',
                    'User-Agent' => 'Mozilla/5.0 (compatible; redirection-io/1.0; +https://redirection.io/)',
                ],
            ]
        );
    }
}
