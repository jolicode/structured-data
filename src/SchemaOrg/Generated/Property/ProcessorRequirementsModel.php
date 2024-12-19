<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ProcessorRequirementsModel
{
    public const DESCRIPTION = 'Processor architecture required to run the application (e.g. IA64).';
    public const LABEL = 'processorRequirements';
    public const NAME = 'schema:processorRequirements';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['SoftwareApplication' => 'Jolicode\SchemaOrg\Type\SoftwareApplicationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
