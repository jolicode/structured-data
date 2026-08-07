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

use Jolicode\JsonLd\Mapper\DocumentWarning;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Extractor
{
    public const NO_SUPPORTED_FORMATS_DETECTED_MESSAGE_PREFIX = 'Could not detect any supported structured data format.';

    /** @var array<DocumentWarning> */
    private array $issues = [];

    public function __construct(
        private ExtractorsContainer $extractorsContainer = new ExtractorsContainer(),
        private readonly LoggerInterface $logger = new NullLogger(),
    ) {
    }

    /**
     * @return array<DocumentWarning>
     */
    public function getDocumentIssues(): array
    {
        return $this->issues;
    }

    /**
     * @param string $document the raw document to extract structured data from - never a
     *                         URL nor a file path: fetching those is the caller's responsibility
     */
    public function extract(string $document): array
    {
        $this->issues = [];
        $content = $document;

        try {
            // Skip format detection if only one extractor is configured
            $preferredFormat = \count($this->extractorsContainer->getExtractors()) > 1
                ? $this->guessPreferredFormat($content)
                : null;
            $results = $this->runExtractors($content, $preferredFormat);
        } finally {
            $this->extractorsContainer->releaseHtmlDocumentCache();
        }

        return $this->getResult($results);
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
    private function getResult(array $results): array
    {
        $elements = [];

        foreach ($results as $result) {
            if ($result['elements']) {
                foreach ($result['elements'] as $element) {
                    $elements[] = $element;
                }
            }
        }

        if ($elements) {
            foreach ($results as $format => $result) {
                if ($result['exception']) {
                    $message = $result['exception']->getMessage();
                    $ranges = $result['exception'] instanceof ExtractionException ? $result['exception']->getRanges() : '';
                    $this->issues[] = new DocumentWarning(
                        $format,
                        $message,
                        $ranges,
                    );
                    $this->logger->warning(\sprintf(
                        'A %s snippet was detected but is malformed and could not be fully processed. Reason: %s',
                        $format,
                        $message,
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
     * @return array<string, array{formatDetected: bool, elements: array<JsonLdElement>, exception: ?\RuntimeException}>
     */
    private function runExtractors(string $content, ?ExtractorFormat $preferredFormat): array
    {
        $results = [];

        foreach ($this->extractorsContainer->getOrderedExtractors($preferredFormat) as $extractor) {
            $format = $extractor->getFormat()->value;

            $results[$format] = [
                'formatDetected' => false,
                'elements' => [],
                'exception' => null,
            ];

            try {
                $results[$format]['elements'] = $extractor->extractStructuredDataContent($content);

                if ($results[$format]['elements']) {
                    $results[$format]['formatDetected'] = true;

                    continue;
                }

                // Microdata can detect format markers but still produce no top-level element.
                if (ExtractorFormat::MICRODATA === $extractor->getFormat()) {
                    $results[$format]['formatDetected'] = $extractor->supportsContent($content);
                }
            } catch (\RuntimeException $runtimeException) {
                $results[$format]['formatDetected'] = true;
                $results[$format]['exception'] = $runtimeException;
            }
        }

        return $results;
    }

    private function guessPreferredFormat(string $content): ?ExtractorFormat
    {
        foreach ($this->extractorsContainer->getExtractors() as $extractor) {
            if ($extractor->supportsContent($content)) {
                return $extractor->getFormat();
            }
        }

        return null;
    }
}
