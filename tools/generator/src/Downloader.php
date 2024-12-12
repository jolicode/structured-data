<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator;

use Jolicode\JsonLd\Generator\SchemaOrg\Generator;
use Jolicode\SchemaOrg\SchemaOrg;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class Downloader
{
    private readonly HttpClientInterface $httpClient;

    public function __construct(
        private Filesystem $filesystem = new Filesystem(),
    ) {
        $this->httpClient = HttpClient::create();
    }

    public function downloadSchemaOrgExamples(): void
    {
        $response = $this->httpClient->request('GET', 'https://raw.githubusercontent.com/schemaorg/schemaorg/main/data/examples.txt');
        $generator = new Generator();
        $generator->generateExamples($response->getContent());
    }

    public function downloadSchemaOrgTypesDefinitionFile(bool $overwrite = false): void
    {
        if (!$overwrite && $this->filesystem->hasSchemaOrgTypesDefinitionFile()) {
            return;
        }

        $url = \sprintf(
            'https://raw.githubusercontent.com/schemaorg/schemaorg/main/data/releases/%s/schemaorg-current-https.jsonld',
            SchemaOrg::VERSION,
        );
        $response = $this->httpClient->request('GET', $url);
        $this->filesystem->saveSchemaOrgTypesDefinitionFile($response->getContent());
    }
}
