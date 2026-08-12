<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Extraction;

class ExtractorsContainer
{
    public const JSONLD = ExtractorFormat::JSONLD->value;
    public const MICRODATA = ExtractorFormat::MICRODATA->value;
    public const RDFA = ExtractorFormat::RDFA->value;

    /**
     * @var list<FormatExtractorInterface>
     */
    private array $extractors;

    /**
     * Shared by all HTML-based extractors so a page body is only parsed once per
     * extraction pass, whichever extractor touches it first.
     */
    private readonly HtmlDocumentLoader $htmlDocumentLoader;

    /**
     * @param list<FormatExtractorInterface>|null $extractors
     */
    public function __construct(?array $extractors = null)
    {
        $this->htmlDocumentLoader = new HtmlDocumentLoader();
        $this->extractors = $extractors ?? [
            new JsonLdNodeExtractor(),
            new MicrodataExtractor($this->htmlDocumentLoader),
            new RdfaExtractor($this->htmlDocumentLoader),
        ];
    }

    /**
     * Releases the memoized DOM document once an extraction pass is over, so that
     * a long-lived process does not keep the last processed page pinned in memory.
     */
    public function releaseHtmlDocumentCache(): void
    {
        $this->htmlDocumentLoader->reset();
    }

    public function resetExtractors(): self
    {
        $this->setExtractors(...$this->getSupportedExtractorNames());

        return $this;
    }

    public function setExtractors(string ...$extractors): self
    {
        if ([] === $extractors) {
            return $this->resetExtractors();
        }

        $this->extractors = [];

        foreach ($extractors as $extractorName) {
            $this->addExtractor($extractorName);
        }

        return $this;
    }

    public function addExtractor(string $extractorName): self
    {
        $extractorFormat = ExtractorFormat::tryFrom($extractorName);

        if (null === $extractorFormat) {
            throw new \InvalidArgumentException(\sprintf('Unknown extractor "%s". Supported extractors are: %s.', $extractorName, implode(', ', $this->getSupportedExtractorNames())));
        }

        foreach ($this->extractors as $extractor) {
            if ($extractorFormat === $extractor->getFormat()) {
                return $this;
            }
        }

        $this->extractors[] = $this->createExtractor($extractorFormat);

        return $this;
    }

    /**
     * @return list<FormatExtractorInterface>
     */
    public function getExtractors(): array
    {
        return $this->extractors;
    }

    /**
     * @return list<FormatExtractorInterface>
     */
    public function getOrderedExtractors(?ExtractorFormat $preferredFormat = null): array
    {
        if (null === $preferredFormat) {
            return $this->extractors;
        }

        $orderedExtractors = [];

        foreach ($this->extractors as $extractor) {
            if ($preferredFormat === $extractor->getFormat()) {
                $orderedExtractors[] = $extractor;
            }
        }

        if (!$orderedExtractors) {
            return $this->extractors;
        }

        foreach ($this->extractors as $extractor) {
            if ($preferredFormat === $extractor->getFormat()) {
                continue;
            }

            $orderedExtractors[] = $extractor;
        }

        return $orderedExtractors;
    }

    /**
     * @return array<string>
     */
    public function getExtractorNames(): array
    {
        return array_map(
            static fn (FormatExtractorInterface $extractor): string => $extractor->getFormat()->value,
            $this->extractors,
        );
    }

    private function createExtractor(ExtractorFormat $extractorFormat): FormatExtractorInterface
    {
        return match ($extractorFormat) {
            ExtractorFormat::JSONLD => new JsonLdNodeExtractor(),
            ExtractorFormat::MICRODATA => new MicrodataExtractor($this->htmlDocumentLoader),
            ExtractorFormat::RDFA => new RdfaExtractor($this->htmlDocumentLoader),
        };
    }

    /**
     * @return list<string>
     */
    private function getSupportedExtractorNames(): array
    {
        return array_map(
            static fn (ExtractorFormat $extractorFormat): string => $extractorFormat->value,
            ExtractorFormat::cases(),
        );
    }
}
