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

final class AuthoritativeLegalValueModel
{
    public const DESCRIPTION = 'Indicates that the publisher gives some special status to the publication of the document. ("The Queens Printer" version of a UK Act of Parliament, or the PDF version of a Directive published by the EU Office of Publications). Something "Authoritative" is considered to be also [[OfficialLegalValue]]".';
    public const LABEL = 'AuthoritativeLegalValue';
    public const NAME = 'schema:AuthoritativeLegalValue';
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1156', 'https://op.europa.eu/en/web/eu-vocabularies/model/-/resource/dataset/eli'];
    public const SUPERSEDED_BY = null;
}
