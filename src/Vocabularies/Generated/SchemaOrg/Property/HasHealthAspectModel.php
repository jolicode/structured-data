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

final class HasHealthAspectModel
{
    public const DESCRIPTION = 'Indicates the aspect or aspects specifically addressed in some [[HealthTopicContent]]. For example, that the content is an overview, or that it talks about treatment, self-care, treatments or their side-effects.';
    public const LABEL = 'hasHealthAspect';
    public const NAME = 'schema:hasHealthAspect';
    public const VALUES = ['HealthAspectEnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HealthAspectEnumerationModel'];
    public const TYPES = ['HealthTopicContent' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HealthTopicContentModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2373'];
    public const SUPERSEDED_BY = null;
}
