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

use Jolicode\JsonLd\Generator\SchemaOrg\Extractor as SchemaOrgExtractor;

readonly class RegisteredExtractorsContainer
{
    public function __construct(
        /**
         * @var ExtractorInterface[]
         */
        private array $extractors = [
            SchemaOrgExtractor::class => new SchemaOrgExtractor(),
        ],
    ) {
    }

    /**
     * @return ExtractorInterface[]
     */
    public function getExtractors(): array
    {
        return $this->extractors;
    }
}
