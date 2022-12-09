<?php

namespace Tests\Transform;

use Jolicode\JsonLd\Flatten\Flatten;
use Symfony\Component\Finder\Finder;

class FlattenTest extends AbstractTransformTest
{
    private const INPUT_FILES = self::FIXTURES_PATH . '/flatten/input';
    private const OUTPUT_FILES = self::FIXTURES_PATH . '/flatten/output';

    /** @dataProvider provideInputsAndOutputs */
    public function testFlatten(string $jsonToFlatten, string $expected)
    {
        $actual = Flatten::flatten(json_decode($jsonToFlatten));

        $this->assertSame($expected, $actual);
    }

    public function provideInputsAndOutputs(): iterable
    {
        $inputFinder = new Finder();
        $inputFinder->files()->in(self::INPUT_FILES);

        foreach ($inputFinder as $inputFile) {
            $outputFile = preg_replace('/-in/', '-out', $inputFile->getFilename());
            $expectedOutput = file_get_contents(sprintf(
                '%s/%s',
                self::OUTPUT_FILES,
                $outputFile
            ));

            yield [$inputFile->getContents(), $expectedOutput];
        }
    }
}
