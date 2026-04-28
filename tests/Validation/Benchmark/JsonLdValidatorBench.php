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

use Jolicode\Vocabularies\Validator;
use Jolicode\Vocabularies\Validators\Google\GoogleValidator;
use Jolicode\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;

class JsonLdValidatorBench
{
    public function __construct(
        private readonly Validator $validator = new Validator(),
    ) {
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchSimpleExpandedValidation(): void
    {
        $this->validator->setValidator(SchemaOrgValidator::class);
        $this->validator->getTypes(file_get_contents(__DIR__ . '/../fixtures/schema-org/simple-expanded.jsonld') ?: '');
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchSimpleCompactedValidation(): void
    {
        $this->validator->setValidator(SchemaOrgValidator::class);
        $this->validator->getTypes(file_get_contents(__DIR__ . '/../fixtures/schema-org/simple-compacted.jsonld') ?: '');
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchSimpleFlattenedValidation(): void
    {
        $this->validator->setValidator(SchemaOrgValidator::class);
        $this->validator->getTypes(file_get_contents(__DIR__ . '/../fixtures/schema-org/simple-flattened.jsonld') ?: '');
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchSimpleFramedValidation(): void
    {
        $this->validator->setValidator(SchemaOrgValidator::class);
        $this->validator->getTypes(file_get_contents(__DIR__ . '/../fixtures/schema-org/simple-framed.jsonld') ?: '');
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchComplexExpandedValidation(): void
    {
        $this->validator->setValidator(SchemaOrgValidator::class);
        $this->validator->getTypes(file_get_contents(__DIR__ . '/../fixtures/schema-org/complex-expanded.jsonld') ?: '');
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchComplexCompactedValidation(): void
    {
        $this->validator->setValidator(SchemaOrgValidator::class);
        $this->validator->getTypes(file_get_contents(__DIR__ . '/../fixtures/schema-org/complex-compacted.jsonld') ?: '');
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchComplexFlattenedValidation(): void
    {
        $this->validator->setValidator(SchemaOrgValidator::class);
        $this->validator->getTypes(file_get_contents(__DIR__ . '/../fixtures/schema-org/complex-flattened.jsonld') ?: '');
    }

    /**
     * @Revs(100)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchComplexFramedValidation(): void
    {
        $this->validator->setValidator(SchemaOrgValidator::class);
        $this->validator->getTypes(file_get_contents(__DIR__ . '/../fixtures/schema-org/complex-framed.jsonld') ?: '');
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchGoogleBookValidation(): void
    {
        $this->validator->setValidator(GoogleValidator::class);
        $this->validator->getTypes(file_get_contents(__DIR__ . '/../fixtures/Google/book.jsonld') ?: '');
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchGoogleQAPageValidation(): void
    {
        $this->validator->setValidator(GoogleValidator::class);
        $this->validator->getTypes(file_get_contents(__DIR__ . '/../fixtures/Google/qapage.jsonld') ?: '');
    }

    /**
     * @Revs(25)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHttpCall(): void
    {
        $this->validator->getTypes('https://jolicode.com/blog/jouer-de-la-musique-dans-le-navigateur-avec-la-web-audio-api');
    }

    /**
     * @Revs(25)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHttpCallWithManyTags(): void
    {
        $this->validator->getTypes('https://raw.githubusercontent.com/schemaorg/schemaorg/main/data/examples.txt');
    }
}
