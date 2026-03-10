<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class BroadcastSignalModulationModel
{
    public const DESCRIPTION = 'The modulation (e.g. FM, AM, etc) used by a particular broadcast service.';
    public const LABEL = 'broadcastSignalModulation';
    public const NAME = 'schema:broadcastSignalModulation';
    public const VALUES = ['QualitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastFrequencySpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\BroadcastFrequencySpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
