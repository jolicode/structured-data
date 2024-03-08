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

final class SourcedFromModel
{
    public const DESCRIPTION = 'The neurological pathway that originates the neurons.';
    public const LABEL = 'sourcedFrom';
    public const NAME = 'schema:sourcedFrom';
    public const VALUES = ['BrainStructureModel' => 'SchemaOrg\Type\BrainStructureModel'];
    public const TYPES = ['Nerve' => 'SchemaOrg\Type\NerveModel'];
}
