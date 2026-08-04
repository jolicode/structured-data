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

final class InteractionStatisticModel
{
    public const DESCRIPTION = 'The number of interactions for the CreativeWork using the WebSite or SoftwareApplication. The most specific child type of InteractionCounter should be used.';
    public const LABEL = 'interactionStatistic';
    public const NAME = 'schema:interactionStatistic';
    public const VALUES = ['InteractionCounterModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\InteractionCounterModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'Organization' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2421'];
    public const SUPERSEDED_BY = null;
}
