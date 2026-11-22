<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms\Http;

use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

/**
 * JSON-LD resolves a relative IRI with the algorithm of RFC 3986 section 5.2
 * and nothing more: no normalization, no percent-encoding.
 */
#[Group('algorithms')]
class IriResolverTest extends TestCase
{
    private const BASE = 'http://a/b/c/d;p?q';

    #[DataProvider('provideRfc3986Examples')]
    public function testTheExamplesOfRfc3986(string $reference, string $expected): void
    {
        $this->assertSame($expected, IriResolver::resolveIri(self::BASE, $reference));
    }

    /**
     * RFC 3986 sections 5.4.1 (normal examples) and 5.4.2 (abnormal examples).
     *
     * @return iterable<string, array{string, string}>
     */
    public static function provideRfc3986Examples(): iterable
    {
        $examples = [
            'g:h' => 'g:h',
            'g' => 'http://a/b/c/g',
            './g' => 'http://a/b/c/g',
            'g/' => 'http://a/b/c/g/',
            '/g' => 'http://a/g',
            '//g' => 'http://g',
            '?y' => 'http://a/b/c/d;p?y',
            'g?y' => 'http://a/b/c/g?y',
            '#s' => 'http://a/b/c/d;p?q#s',
            'g#s' => 'http://a/b/c/g#s',
            'g?y#s' => 'http://a/b/c/g?y#s',
            ';x' => 'http://a/b/c/;x',
            'g;x' => 'http://a/b/c/g;x',
            'g;x?y#s' => 'http://a/b/c/g;x?y#s',
            '' => 'http://a/b/c/d;p?q',
            '.' => 'http://a/b/c/',
            './' => 'http://a/b/c/',
            '..' => 'http://a/b/',
            '../' => 'http://a/b/',
            '../g' => 'http://a/b/g',
            '../..' => 'http://a/',
            '../../' => 'http://a/',
            '../../g' => 'http://a/g',
            '../../../g' => 'http://a/g',
            '../../../../g' => 'http://a/g',
            '/./g' => 'http://a/g',
            '/../g' => 'http://a/g',
            'g.' => 'http://a/b/c/g.',
            '.g' => 'http://a/b/c/.g',
            'g..' => 'http://a/b/c/g..',
            '..g' => 'http://a/b/c/..g',
            './../g' => 'http://a/b/g',
            './g/.' => 'http://a/b/c/g/',
            'g/./h' => 'http://a/b/c/g/h',
            'g/../h' => 'http://a/b/c/h',
            'g;x=1/./y' => 'http://a/b/c/g;x=1/y',
            'g;x=1/../y' => 'http://a/b/c/y',
            'g?y/./x' => 'http://a/b/c/g?y/./x',
            'g?y/../x' => 'http://a/b/c/g?y/../x',
            'g#s/./x' => 'http://a/b/c/g#s/./x',
            'g#s/../x' => 'http://a/b/c/g#s/../x',
            'http:g' => 'http:g',
        ];

        foreach ($examples as $reference => $expected) {
            yield \sprintf('"%s"', $reference) => [(string) $reference, $expected];
        }
    }

    #[DataProvider('provideReferences')]
    public function testNothingIsNormalized(?string $base, string $reference, string $expected): void
    {
        $this->assertSame($expected, IriResolver::resolveIri($base, $reference));
    }

    /**
     * @return iterable<string, array{string|null, string, string}>
     */
    public static function provideReferences(): iterable
    {
        yield 'a query keeps the dot segments of the base' => ['http://a/bb/ccc/./d;p?q', '?y', 'http://a/bb/ccc/./d;p?y'];
        yield 'a fragment keeps the dot segments of the base' => ['http://a/bb/ccc/../d;p?q', '#s', 'http://a/bb/ccc/../d;p?q#s'];
        yield 'an empty reference keeps the dot segments of the base' => ['http://a/bb/ccc/../d;p?q#f', '', 'http://a/bb/ccc/../d;p?q'];
        yield 'a fragment replaces the fragment of the base' => ['http://a/b?q#old', '#new', 'http://a/b?q#new'];
        yield 'a query replaces the query and the fragment of the base' => ['http://a/b?old#f', '?new', 'http://a/b?new'];
        yield 'a path merges with a base holding dot segments' => ['http://a/bb/ccc/../d;p?q', '../../', 'http://a/'];
        yield 'the root keeps its slash' => ['http://a/b', '..', 'http://a/'];
        yield 'a base without a path' => ['http://a', 'g', 'http://a/g'];
        yield 'a file base' => ['file:///a/bb/ccc/d;p?q', 'g?y', 'file:///a/bb/ccc/g?y'];
        yield 'characters of an IRI are not percent-encoded' => ['http://example.com/', 'é/ü?ñ#ø', 'http://example.com/é/ü?ñ#ø'];
        yield 'the host keeps its case' => ['http://EXAMPLE.com/A/%7euser', 'x', 'http://EXAMPLE.com/A/x'];
        yield 'percent-encoded characters are left alone' => ['http://example.com/', '%7Euser/%c3%a9', 'http://example.com/%7Euser/%c3%a9'];
        yield 'an absolute IRI is not touched' => ['http://example.com/', 'http://other.example/a/../b', 'http://other.example/a/../b'];
        yield 'a blank node identifier is not touched' => ['http://example.com/', '_:b0', '_:b0'];
        yield 'no base' => [null, 'relative', 'relative'];
        yield 'an empty base' => ['', 'relative', 'relative'];
        yield 'a reference that is not an IRI stays as it is' => ['http://example.com/', 'a b', 'a b'];
        yield 'characters an IRI may not hold are not percent-encoded either' => ['http://example.com/', 'a/<b>', 'http://example.com/a/<b>'];
    }
}
