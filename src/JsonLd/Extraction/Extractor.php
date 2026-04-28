<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Extraction;

use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Extractor
{
    public const NO_SUPPORTED_FORMATS_DETECTED_MESSAGE_PREFIX = 'Could not detect any supported structured data format.';

    private HttpClientInterface $httpClient;

    /** @var array<ExtractionWarning> */
    private array $lastWarnings = [];

    public function __construct(
        private ExtractorsContainer $extractorsContainer = new ExtractorsContainer(),
        ?HttpClientInterface $httpClient = null,
        private readonly LoggerInterface $logger = new NullLogger(),
    ) {
        $this->httpClient = $httpClient ?? HttpClient::create();
    }

    /**
     * @return array<ExtractionWarning>
     */
    public function getLastExtractionWarnings(): array
    {
        return $this->lastWarnings;
    }

    public function extract(string $input): array
    {
        $this->lastWarnings = [];
        $content = $this->resolveInputContent($input);
        $preferredFormat = $this->guessPreferredFormat($content);
        $results = $this->runExtractors($content, $preferredFormat);

        return $this->resolveExtractionResults($results);
    }

    public function setExtractors(string ...$extractors): self
    {
        $this->extractorsContainer->setExtractors(...$extractors);

        return $this;
    }

    /**
     * @param array<string, array{formatDetected: bool, elements: array<JsonLdElement>, exception: ?\RuntimeException}> $results
     *
     * @return array<JsonLdElement>
     */
    private function resolveExtractionResults(array $results): array
    {
        $elements = [];

        foreach ($results as $result) {
            if ($result['elements']) {
                $elements = [...$elements, ...$result['elements']];
            }
        }

        if ($elements) {
            foreach ($results as $format => $result) {
                if ($result['exception']) {
                    $this->lastWarnings[] = new ExtractionWarning($format, $result['exception']->getMessage());
                    $this->logger->warning(\sprintf(
                        'A %s snippet was detected but is malformed and could not be fully processed. Reason: %s',
                        $format,
                        $result['exception']->getMessage(),
                    ));
                }
            }

            return $elements;
        }

        foreach ($results as $result) {
            if ($result['exception']) {
                throw $result['exception'];
            }
        }

        foreach ($results as $format => $result) {
            if ($result['formatDetected']) {
                throw new \RuntimeException(\sprintf('Detected structured data format "%s" but could not extract any usable content.', $format));
            }
        }

        throw new \RuntimeException(\sprintf('%s Supported formats are: %s.', self::NO_SUPPORTED_FORMATS_DETECTED_MESSAGE_PREFIX, implode(', ', $this->extractorsContainer->getExtractorNames())));
    }

    /**
     * @param 'jsonld'|'microdata'|'rdfa'|null $preferredFormat
     *
     * @return array<string, array{formatDetected: bool, elements: array<JsonLdElement>, exception: ?\RuntimeException}>
     */
    private function runExtractors(string $content, ?string $preferredFormat): array
    {
        $results = [];

        foreach ($this->extractorsContainer->getOrderedExtractors($preferredFormat) as $format => $extractor) {
            $results[$format] = [
                'formatDetected' => false,
                'elements' => [],
                'exception' => null,
            ];

            if (!$extractor->supportsContent($content)) {
                continue;
            }

            $results[$format]['formatDetected'] = true;

            try {
                $results[$format]['elements'] = $extractor->extractStructuredDataContent($content);
            } catch (\RuntimeException $runtimeException) {
                $results[$format]['exception'] = $runtimeException;
            }
        }

        return $results;
    }

    private function resolveInputContent(string $input): string
    {
        if (IriResolver::isAbsoluteIri($input)) {
            return $this->fetchContent($input);
        }

        if (!is_file($input)) {
            return $input;
        }

        $content = file_get_contents($input);

        if (false === $content) {
            throw new \RuntimeException(\sprintf('Could not read the file %s', $input));
        }

        return $content;
    }

    private function fetchContent(string $url): string
    {
        $response = $this->httpClient->request('GET', $url);

        return $response->getContent();
    }

    /**
     * @return 'jsonld'|'microdata'|'rdfa'|null
     */
    private function guessPreferredFormat(string $content): ?string
    {
        foreach ($this->extractorsContainer->getExtractors() as $format => $extractor) {
            if (!$extractor->supportsContent($content)) {
                continue;
            }

            if (\array_key_exists($format, ExtractorsContainer::EXTRACTOR_CLASSES)) {
                return $format;
            }
        }

        return null;
    }
}
