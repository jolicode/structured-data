<?php

namespace Tests\Transform;

use Jolicode\JsonLd\Flatten\Flattener;

class FlattenTest extends AbstractTransformTest
{
    /** @dataProvider provideInputsAndOutputs */
    public function testFlatten(string $jsonToFlatten, string $expected): never
    {
        $flattener = new Flattener();
        $actual = $flattener->flatten(json_decode($jsonToFlatten));

        $this->assertSame($expected, $actual);
    }

    public function provideInputsAndOutputs(): iterable
    {
        foreach ($this->getInputFiles() as $inputFile) {
            $outputFile = $this->getOutputFile(
                preg_replace('/-in/', '-out', $inputFile->getFilename())

            );

            yield [
                $inputFile->getContents(),
                file_get_contents($outputFile)
            ];
        }
    }

    protected function getAlgorithmName(): string
    {
        return self::ALGO_FLATTEN;
    }
}
