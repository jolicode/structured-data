<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Validation;

use JoliCode\StructuredData\Extraction\ExtractorFormat;
use JoliCode\StructuredData\Extraction\JsonLdElement;
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\ObjectStructure;
use JoliCode\StructuredData\JsonLd\Parser\JsonLdParser;
use JoliCode\StructuredData\Mapper\ValidationMapper;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('validation')]
class ValidationMapperReuseTest extends TestCase
{
    private const DOCUMENT = '{"@context":"https://schema.org","@type":"Person","name":"Ada Lovelace"}';

    /**
     * A mapper instance must stay usable across documents: map() used to unset a
     * typed property, leaving it uninitialized, so a second call blew up in
     * mapFlattenedTypes() instead of mapping the document.
     *
     * Without an intervening reset() the mapped types accumulate, which is the
     * documented behaviour; what matters here is that the call succeeds.
     */
    public function testMapCanRunTwiceOnTheSameInstanceWithoutReset(): void
    {
        $mapper = new ValidationMapper();

        $first = $mapper->map(...$this->arguments());
        $second = $mapper->map(...$this->arguments());

        $this->assertCount(1, $first);
        $this->assertCount(2, $second);
        $this->assertSame(['Person'], $second[1]->getType());
        $this->assertSame('Ada Lovelace', $second[1]->getName());
    }

    public function testMapCanRunTwiceOnTheSameInstanceAfterReset(): void
    {
        $mapper = new ValidationMapper();

        $mapper->map(...$this->arguments());
        $mapper->reset();
        $mapped = $mapper->map(...$this->arguments());

        $this->assertCount(1, $mapped);
        $this->assertSame(['Person'], $mapped[0]->getType());
    }

    /**
     * @return array{array<\stdClass>, ObjectStructure, string}
     */
    private function arguments(): array
    {
        $element = new JsonLdElement(0, 0, self::DOCUMENT, ExtractorFormat::JSONLD);
        $parsed = (new JsonLdParser())->parse($element);

        self::assertInstanceOf(ObjectStructure::class, $parsed);

        $expanded = (new Expander())->expand(self::DOCUMENT, encodeResult: false);

        /** @var array<\stdClass> $expanded */
        $expanded = \is_array($expanded) ? $expanded : [$expanded];

        return [$expanded, $parsed, ExtractorFormat::JSONLD->value];
    }
}
