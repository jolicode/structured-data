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

final class OffersPrescriptionByMailModel
{
    public const DESCRIPTION = 'Whether prescriptions can be delivered by mail.';
    public const LABEL = 'offersPrescriptionByMail';
    public const NAME = 'schema:offersPrescriptionByMail';
    public const VALUES = ['BooleanModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['HealthPlanFormulary' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HealthPlanFormularyModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1062'];
    public const SUPERSEDED_BY = null;
}
