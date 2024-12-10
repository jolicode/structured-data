<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Validation\Benchmark;

use Jolicode\JsonLd\Validation\JsonLdValidator;

class JsonLdValidatorBench
{
    public function __construct(
        private readonly JsonLdValidator $validator = new JsonLdValidator(),
    ) {
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchSimpleExpandedValidation()
    {
        $this->validator->validate(file_get_contents(__DIR__ . '/../fixtures/SchemaOrg/simple-expanded.jsonld'));
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchSimpleCompactedValidation()
    {
        $this->validator->validate(file_get_contents(__DIR__ . '/../fixtures/SchemaOrg/simple-compacted.jsonld'));
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchSimpleFlattenedValidation()
    {
        $this->validator->validate(file_get_contents(__DIR__ . '/../fixtures/SchemaOrg/simple-flattened.jsonld'));
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchSimpleFramedValidation()
    {
        $this->validator->validate(file_get_contents(__DIR__ . '/../fixtures/SchemaOrg/simple-framed.jsonld'));
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchComplexExpandedValidation()
    {
        $this->validator->validate(file_get_contents(__DIR__ . '/../fixtures/SchemaOrg/complex-expanded.jsonld'));
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchComplexCompactedValidation()
    {
        $this->validator->validate(file_get_contents(__DIR__ . '/../fixtures/SchemaOrg/complex-compacted.jsonld'));
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchComplexFlattenedValidation()
    {
        $this->validator->validate(file_get_contents(__DIR__ . '/../fixtures/SchemaOrg/complex-flattened.jsonld'));
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchComplexFramedValidation()
    {
        $this->validator->validate(file_get_contents(__DIR__ . '/../fixtures/SchemaOrg/complex-framed.jsonld'));
    }

    /**
     * @Revs(25)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHttpCall()
    {
        $this->validator->validate('https://jolicode.com/blog/jouer-de-la-musique-dans-le-navigateur-avec-la-web-audio-api');
    }

    /**
     * @Revs(25)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHttpCallWithManyTags()
    {
        $this->validator->validate('https://raw.githubusercontent.com/schemaorg/schemaorg/main/data/examples.txt');
    }
}
