<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generators;

use Jolicode\Vocabularies\Generators\Google\Generator as GoogleGenerator;
use Jolicode\Vocabularies\Generators\SchemaOrg\Generator as SchemaOrgGenerator;

readonly class GeneratorsContainer
{
    private const GENERATOR_ALIASES = [
        'schemaorg' => 'schema-org',
        'google' => 'google',
    ];

    public function __construct(
        /**
         * @var GeneratorInterface[]
         */
        private array $generators = [
            'schema-org' => new SchemaOrgGenerator(),
            'google' => new GoogleGenerator(),
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
        $name = self::GENERATOR_ALIASES[$this->normalizeGeneratorName($name)] ?? $name;

        if (!\array_key_exists($name, $this->generators)) {
            throw new \InvalidArgumentException(\sprintf('Unknown generator "%s". Accepted values are: %s', $name, implode(', ', array_keys($this->generators))));
        }

        return $this->generators[$name];
    }

    private function normalizeGeneratorName(string $name): string
    {
        return str_replace(['.', '-', '_'], '', strtolower($name));
    }
}
