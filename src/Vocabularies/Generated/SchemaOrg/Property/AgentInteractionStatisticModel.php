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

final class AgentInteractionStatisticModel
{
    public const DESCRIPTION = 'The number of completed interactions for this entity, in a particular role (the \'agent\'), in a particular action (indicated in the statistic), and in a particular context (i.e. interactionService).';
    public const LABEL = 'agentInteractionStatistic';
    public const NAME = 'schema:agentInteractionStatistic';
    public const VALUES = ['InteractionCounterModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\InteractionCounterModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2858'];
    public const SUPERSEDED_BY = null;
}
