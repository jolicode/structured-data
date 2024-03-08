<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class BroadcastSignalModulationModel
{
    public const DESCRIPTION = 'The modulation (e.g. FM, AM, etc) used by a particular broadcast service.';
    public const LABEL = 'broadcastSignalModulation';
    public const NAME = 'schema:broadcastSignalModulation';
    public const VALUES = ['QualitativeValueModel' => 'SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastFrequencySpecification' => 'SchemaOrg\Type\BroadcastFrequencySpecificationModel'];
}
