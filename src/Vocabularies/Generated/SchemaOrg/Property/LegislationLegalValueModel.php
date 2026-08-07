<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class LegislationLegalValueModel
{
    public const DESCRIPTION = 'The legal value of this legislation file. The same legislation can be written in multiple files with different legal values. Typically a digitally signed PDF have a "stronger" legal value than the HTML file of the same act.';
    public const LABEL = 'legislationLegalValue';
    public const NAME = 'schema:legislationLegalValue';
    public const VALUES = ['LegalValueLevelModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\LegalValueLevelModel'];
    public const TYPES = ['LegislationObject' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\LegislationObjectModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1156', 'https://op.europa.eu/en/web/eu-vocabularies/model/-/resource/dataset/eli'];
    public const SUPERSEDED_BY = null;
}
