<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class AlgorithmModel
{
    public const DESCRIPTION = 'The algorithm or rules to follow to compute the score.';
    public const LABEL = 'algorithm';
    public const NAME = 'schema:algorithm';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalRiskScore' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalRiskScoreModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
