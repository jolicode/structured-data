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

final class DistributionModel
{
    public const DESCRIPTION = 'A downloadable form of this dataset, at a specific location, in a specific format. This property can be repeated if different variations are available. There is no expectation that different downloadable distributions must contain exactly equivalent information (see also [DCAT](https://www.w3.org/TR/vocab-dcat-3/#Class:Distribution) on this point). Different distributions might include or exclude different subsets of the entire dataset, for example.';
    public const LABEL = 'distribution';
    public const NAME = 'schema:distribution';
    public const VALUES = ['DataDownloadModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DataDownloadModel'];
    public const TYPES = ['Dataset' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DatasetModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
