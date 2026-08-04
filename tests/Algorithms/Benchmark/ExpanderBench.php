<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Algorithms\Benchmark;

use Jolicode\JsonLd\Algorithms;
use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;

class ExpanderBench extends AbstractJsonLdBench
{
    public function __construct(
        private readonly Expander $expander = new Expander(),
        private readonly ProcessorOptions $options = new ProcessorOptions(
        ),
    ) {
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchMinimalDocumentExpansion(): void
    {
        $this->expandJsonFile('0002-in.jsonld');
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchNestedGraphExpansion(): void
    {
        $this->expandJsonFile('pr25-in.jsonld');
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchContextHeavyExpansion(): void
    {
        $this->expandJsonFile('0036-in.jsonld');
    }

    /**
     * Documents whose graph nodes each repeat the schema.org remote context are
     * common in the wild. Every repetition applies the context to an already
     * populated active context, which the processed-context cache cannot serve:
     * this is the regression guard for applying it from the static data instead
     * of rebuilding its ~3.000 term definitions.
     *
     * @Revs(20)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchRepeatedRemoteContextExpansion(): void
    {
        $nodes = [];

        for ($i = 0; $i < 8; ++$i) {
            $nodes[] = \sprintf('{"@context": "https://schema.org", "@type": "Person", "name": "person %d"}', $i);
        }

        $this->expander->expand(\sprintf('{"@context": "https://schema.org", "@graph": [%s]}', implode(',', $nodes)));
    }

    protected function getAlgorithmName(): string
    {
        return Algorithms::EXPAND->value;
    }

    private function expandJsonFile(string $filename): void
    {
        $json = $this->loadJson($filename);
        $this->options->base = $this->getBaseUrlForW3CTests($filename);

        $this->expander->expand($json, $this->options);
    }
}
