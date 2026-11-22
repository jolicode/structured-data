<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms\Rdf;

use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\CanonicalLexicalForm;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\JsonCanonicalizer;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\WellFormedness;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('rdf')]
class LexicalFormTest extends TestCase
{
    #[DataProvider('provideDoubles')]
    public function testCanonicalDouble(int|float $value, string $expected): void
    {
        $this->assertSame($expected, CanonicalLexicalForm::double($value));
    }

    /**
     * @return iterable<string, array{int|float, string}>
     */
    public static function provideDoubles(): iterable
    {
        yield 'one' => [1, '1.0E0'];
        yield 'a fraction' => [5.3, '5.3E0'];
        yield 'negative' => [-0.5, '-5.0E-1'];
        yield 'large' => [1.0E21, '1.0E21'];
        yield 'small' => [0.00000123, '1.23E-6'];
        yield 'fifteen digits' => [1.234567890123456, '1.234567890123456E0'];
        yield 'zero' => [0.0, '0.0E0'];
        yield 'infinity' => [\INF, 'INF'];
        yield 'minus infinity' => [-\INF, '-INF'];
        yield 'not a number' => [\NAN, 'NaN'];
    }

    #[DataProvider('provideIntegers')]
    public function testCanonicalInteger(int|float $value, string $expected): void
    {
        $this->assertSame($expected, CanonicalLexicalForm::integer($value));
    }

    /**
     * @return iterable<string, array{int|float, string}>
     */
    public static function provideIntegers(): iterable
    {
        yield 'an integer' => [42, '42'];
        yield 'a negative integer' => [-42, '-42'];
        yield 'a float without fraction' => [1.0, '1'];
        yield 'a float too large for an int' => [1.0E20, '100000000000000000000'];
        yield 'minus zero' => [-0.0, '0'];
    }

    public function testWhichNumbersAreDoubles(): void
    {
        $this->assertFalse(CanonicalLexicalForm::isDouble(1));
        $this->assertFalse(CanonicalLexicalForm::isDouble(1.0));
        $this->assertFalse(CanonicalLexicalForm::isDouble(1.0E20));
        $this->assertTrue(CanonicalLexicalForm::isDouble(1.5));
        $this->assertTrue(CanonicalLexicalForm::isDouble(1.0E21));
        $this->assertTrue(CanonicalLexicalForm::isDouble(-1.0E21));
    }

    public function testBooleans(): void
    {
        $this->assertSame('true', CanonicalLexicalForm::boolean(true));
        $this->assertSame('false', CanonicalLexicalForm::boolean(false));
    }

    #[DataProvider('provideJson')]
    public function testJsonCanonicalization(string $json, string $expected): void
    {
        $this->assertSame($expected, JsonCanonicalizer::canonicalize(json_decode($json)));
    }

    /**
     * The numbers are the ones of RFC 8785, appendix B.
     *
     * @return iterable<string, array{string, string}>
     */
    public static function provideJson(): iterable
    {
        yield 'literals' => ['[null, true, false]', '[null,true,false]'];
        yield 'empty object and array' => ['{"b": [], "a": {}}', '{"a":{},"b":[]}'];
        yield 'keys sorted by UTF-16 code units' => ['{"\u20ac": 1, "\r": 2, "\ud83d\ude00": 3, "\ufb33": 4, "1": 5, "\u0080": 6, "\u00f6": 7}', "{\"\\r\":2,\"1\":5,\"\u{80}\":6,\"ö\":7,\"€\":1,\"😀\":3,\"\u{FB33}\":4}"];
        yield 'string escapes' => ['"\u20ac$\u000f\nA\'B\"\\\\\"/"', '"€$\u000f\nA\'B\"\\\\\"/"'];
        yield 'nested' => ['{"numbers": [333333333.33333329, 1E30, 4.50, 2e-3, 0.000000000000000000000000001], "literals": [null, true, false]}', '{"literals":[null,true,false],"numbers":[333333333.3333333,1e+30,4.5,0.002,1e-27]}'];
        yield 'zero' => ['[0, 0.0, -0.0]', '[0,0,0]'];
        yield 'integer valued float' => ['[1.0, 100.0, 1e2]', '[1,100,100]'];
        yield 'largest decimal notation' => ['[1e20, 123456789012345680000, 1e21]', '[100000000000000000000,123456789012345680000,1e+21]'];
        yield 'smallest decimal notation' => ['[0.000001, 0.0000001]', '[0.000001,1e-7]'];
        yield 'extremes' => ['[5e-324, 1.7976931348623157e308, -1.7976931348623157e308]', '[5e-324,1.7976931348623157e+308,-1.7976931348623157e+308]'];
        yield 'shortest round trip' => ['[0.1, 0.30000000000000004, 9007199254740992, 295147905179352830000, 9.999999999999997e22]', '[0.1,0.30000000000000004,9007199254740992,295147905179352830000,9.999999999999997e+22]'];
    }

    public function testWellFormedIris(): void
    {
        $this->assertTrue(WellFormedness::isIri('http://example.com/a?b#c'));
        $this->assertTrue(WellFormedness::isIri('urn:ex:s'));
        $this->assertFalse(WellFormedness::isIri('relative'));
        $this->assertFalse(WellFormedness::isIri('http://example.com/a b'));
        $this->assertFalse(WellFormedness::isIri('http://example.com/<a>'));
        $this->assertFalse(WellFormedness::isIri('http://example.com/#a#b'));
        $this->assertFalse(WellFormedness::isIri('_:b0'));
        $this->assertFalse(WellFormedness::isIri(null));
    }

    public function testWellFormedBlankNodesAndLanguageTags(): void
    {
        $this->assertTrue(WellFormedness::isBlankNode('_:b0'));
        $this->assertFalse(WellFormedness::isBlankNode('_:b 0'));
        $this->assertFalse(WellFormedness::isBlankNode('http://example.com/'));

        $this->assertTrue(WellFormedness::isLanguageTag('en'));
        $this->assertTrue(WellFormedness::isLanguageTag('zh-Hant-TW'));
        $this->assertFalse(WellFormedness::isLanguageTag('en us'));
        $this->assertFalse(WellFormedness::isLanguageTag('a-very-long-subtag-123456789'));
        $this->assertFalse(WellFormedness::isLanguageTag(''));
    }
}
