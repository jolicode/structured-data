<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator;

use Jolicode\JsonLd\Generator\Google\Generator as GoogleGenerator;
use Jolicode\JsonLd\Generator\SchemaOrg\Generator as SchemaOrgGenerator;

readonly class GeneratorsContainer
{
    public function __construct(
        /**
         * @var GeneratorInterface[]
         */
        private array $generators = [
            'schemaorg' => new SchemaOrgGenerator(),
            // 'google' => new GoogleGenerator(),
        ],
    ) {
    }

    /**
     * @return GeneratorInterface[]
     */
    public function getGenerators(): array
    {
        return $this->generators;
    }

    public function getGenerator(string $name): GeneratorInterface
    {
        if (!\array_key_exists($name, $this->generators)) {
            throw new \InvalidArgumentException(\sprintf('Unknown generator "%s". Accepted values are: %s', $name, implode(', ', array_keys($this->generators))));
        }

        return $this->generators[$name];
    }
}
