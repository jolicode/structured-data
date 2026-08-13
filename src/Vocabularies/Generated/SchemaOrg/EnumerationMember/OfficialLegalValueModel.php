<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\EnumerationMember;

final class OfficialLegalValueModel
{
    public const DESCRIPTION = 'All the documents published by an official publisher should have at least the legal value level "OfficialLegalValue". This indicates that the document was published by an organisation with the public task of making it available (e.g. a consolidated version of a EU directive published by the EU Office of Publications).';
    public const LABEL = 'OfficialLegalValue';
    public const NAME = 'schema:OfficialLegalValue';
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1156', 'https://op.europa.eu/en/web/eu-vocabularies/model/-/resource/dataset/eli'];
    public const SUPERSEDED_BY = null;
}
