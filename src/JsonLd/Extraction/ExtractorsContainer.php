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

class ExtractorsContainer
{
    public const JSONLD = 'jsonld';
    public const MICRODATA = 'microdata';
    public const RDFA = 'rdfa';

    public const EXTRACTOR_CLASSES = [
        self::JSONLD => JsonLdNodeExtractor::class,
        self::MICRODATA => MicrodataExtractor::class,
        self::RDFA => RdfaExtractor::class,
    ];

    public function __construct(
        /**
         * @var array<string, FormatExtractorInterface>
         */
        private array $extractors = [
            self::JSONLD => new JsonLdNodeExtractor(),
            self::MICRODATA => new MicrodataExtractor(),
            self::RDFA => new RdfaExtractor(),
        ],
    ) {
    }

    public function resetExtractors(): self
    {
        $this->setExtractors(...array_keys(self::EXTRACTOR_CLASSES));

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
        if ($shortName = array_search($extractorName, self::EXTRACTOR_CLASSES, true)) {
            $extractorName = $shortName;
        }

        $this->assertSupportedExtractorName($extractorName);

        if (\array_key_exists($extractorName, $this->extractors)) {
            return $this;
        }

        $extractorClass = self::EXTRACTOR_CLASSES[$extractorName];
        $this->extractors[$extractorName] = new $extractorClass();

        return $this;
    }

    /**
     * @return array<string, FormatExtractorInterface>
     */
    public function getExtractors(): array
    {
        return $this->extractors;
    }

    /**
     * @param 'jsonld'|'microdata'|'rdfa'|null $preferredFormat
     *
     * @return array<string, FormatExtractorInterface>
     */
    public function getOrderedExtractors(?string $preferredFormat = null): array
    {
        if (null === $preferredFormat || !\array_key_exists($preferredFormat, $this->extractors)) {
            return $this->extractors;
        }

        $orderedExtractors = [$preferredFormat => $this->extractors[$preferredFormat]];

        foreach ($this->extractors as $format => $extractor) {
            if ($format === $preferredFormat) {
                continue;
            }

            $orderedExtractors[$format] = $extractor;
        }

        return $orderedExtractors;
    }

    /**
     * @return array<string>
     */
    public function getExtractorNames(): array
    {
        return array_keys($this->extractors);
    }

    private function assertSupportedExtractorName(string $extractorName): void
    {
        if (\array_key_exists($extractorName, self::EXTRACTOR_CLASSES)) {
            return;
        }

        throw new \InvalidArgumentException(\sprintf('Unknown extractor "%s". Supported extractors are: %s.', $extractorName, implode(', ', array_keys(self::EXTRACTOR_CLASSES))));
    }
}
