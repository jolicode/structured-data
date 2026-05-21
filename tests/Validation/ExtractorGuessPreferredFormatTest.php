<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Validation;

use Jolicode\JsonLd\Extraction\Extractor;
use Jolicode\JsonLd\Extraction\ExtractorsContainer;
use PHPUnit\Framework\TestCase;

/**
 * @group validation
 */
class ExtractorGuessPreferredFormatTest extends TestCase
{
    public function testItDetectsJsonLdFromScriptTag(): void
    {
        $content = <<<'HTML'
            <html>
              <body>
                <script type="application/ld+json">{"@context":"https://schema.org","@type":"Person","name":"Alice"}</script>
              </body>
            </html>
            HTML;

        $this->assertSame(ExtractorsContainer::JSONLD, $this->guessPreferredFormat($content));
    }

    public function testItDetectsJsonLdFromRawJsonDocument(): void
    {
        $this->assertSame(
            ExtractorsContainer::JSONLD,
            $this->guessPreferredFormat('{"@context":"https://schema.org","@type":"Person","name":"Alice"}'),
        );
    }

    public function testItDetectsMicrodata(): void
    {
        $content = <<<'HTML'
            <html>
              <body>
                <div itemscope itemtype="https://schema.org/Person">
                  <span itemprop="name">Alice</span>
                </div>
              </body>
            </html>
            HTML;

        $this->assertSame(ExtractorsContainer::MICRODATA, $this->guessPreferredFormat($content));
    }

    public function testItDetectsRdfa(): void
    {
        $content = <<<'HTML'
            <html>
              <body>
                <div vocab="https://schema.org/" typeof="Person">
                  <span property="name">Alice</span>
                </div>
              </body>
            </html>
            HTML;

        $this->assertSame(ExtractorsContainer::RDFA, $this->guessPreferredFormat($content));
    }

    public function testItReturnsNullForPlainHtml(): void
    {
        $content = <<<'HTML'
            <html>
              <body>
                <p>Hello world</p>
              </body>
            </html>
            HTML;

        $this->assertNull($this->guessPreferredFormat($content));
    }

    public function testItPrefersJsonLdOverMicrodataWhenBothArePresent(): void
    {
        $content = <<<'HTML'
            <html>
              <body>
                <script type="application/ld+json">{"@context":"https://schema.org","@type":"Person","name":"Alice"}</script>
                <div itemscope itemtype="https://schema.org/Person">
                  <span itemprop="name">Alice</span>
                </div>
              </body>
            </html>
            HTML;

        $this->assertSame(ExtractorsContainer::JSONLD, $this->guessPreferredFormat($content));
    }

    public function testItPrefersJsonLdOverRdfaWhenBothArePresent(): void
    {
        $content = <<<'HTML'
            <html>
              <body>
                <script type="application/ld+json">{"@context":"https://schema.org","@type":"Person","name":"Alice"}</script>
                <div vocab="https://schema.org/" typeof="Person">
                  <span property="name">Alice</span>
                </div>
              </body>
            </html>
            HTML;

        $this->assertSame(ExtractorsContainer::JSONLD, $this->guessPreferredFormat($content));
    }

    public function testItPrefersMicrodataOverRdfaWhenBothArePresentAndJsonLdIsDisabled(): void
    {
        $container = (new ExtractorsContainer())->setExtractors(
            ExtractorsContainer::MICRODATA,
            ExtractorsContainer::RDFA,
        );

        $content = <<<'HTML'
            <html>
              <body>
                <div itemscope itemtype="https://schema.org/Person">
                  <span itemprop="name">Alice</span>
                </div>
                <div vocab="https://schema.org/" typeof="Person">
                  <span property="name">Alice</span>
                </div>
              </body>
            </html>
            HTML;

        $this->assertSame(ExtractorsContainer::MICRODATA, $this->guessPreferredFormat($content, $container));
    }

    public function testItReturnsNullWhenNoConfiguredExtractorSupportsTheContent(): void
    {
        $container = (new ExtractorsContainer())->setExtractors(ExtractorsContainer::JSONLD);

        $content = <<<'HTML'
            <html>
              <body>
                <div itemscope itemtype="https://schema.org/Person">
                  <span itemprop="name">Alice</span>
                </div>
              </body>
            </html>
            HTML;

        $this->assertNull($this->guessPreferredFormat($content, $container));
    }

    private function guessPreferredFormat(string $content, ?ExtractorsContainer $container = null): ?string
    {
        $extractor = new Extractor($container ?? new ExtractorsContainer());
        $method = new \ReflectionMethod($extractor, 'guessPreferredFormat');

        return $method->invoke($extractor, $content)?->value;
    }
}
