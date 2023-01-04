<?php

namespace Tests;

use Jolicode\JsonLd\Fixtures\FixturesManager;
use Jolicode\JsonLd\Flatten\Flattener;

class FlattenerTest extends AbstractJsonLdTest
{
    /** @dataProvider provideInputsAndOutputs */
    public function testFlatten(string $jsonToFlatten, string $expected): void
    {
        $this->installTestSuite();

        $flattener = new Flattener();
        $actual = $flattener->flatten(json_decode($jsonToFlatten));

        $this->assertSame($expected, $actual);
    }

    public function provideInputsAndOutputs(): iterable
    {
        foreach ($this->getInputFiles() as $inputFileName => $inputFile) {
            if ($this->shouldSkipThisTest($inputFile->getFilename())) {
                continue;
            }

            $outputFileName = $this->getOutputFileName(
                preg_replace('/-in/', '-out', $inputFile->getFilename()),
            );

            if (!is_file($outputFileName)) {
                // TODO : log a warning/an error instead
                dump(sprintf(
                    'A file could not be found. Input filename is %s, output filename is %s',
                    $inputFileName,
                    $outputFileName,
                ));

                continue;
            }

            yield [
                'jsonToFlatten' => $inputFile->getContents(),
                'expected' => file_get_contents($outputFileName)
            ];
        }
    }

    protected function getAlgorithmName(): string
    {
        return FixturesManager::ALGO_FLATTEN;
    }

    /**
     * There are a lot of tests available in the W3C test suite and some have a behaviour that (curently) break the tests.
     * Some input files, for example, are split in two and only have one output counterpart.
     * For now we skip them but this is a TODO : we should take care of them.
     */
    private function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [
            'e001-in.jsonld',
        ];

        return in_array($filename, $testsToSkip);
    }
}
