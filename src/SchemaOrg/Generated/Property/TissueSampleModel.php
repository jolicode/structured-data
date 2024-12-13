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

final class TissueSampleModel
{
    public const DESCRIPTION = 'The type of tissue sample required for the test.';
    public const LABEL = 'tissueSample';
    public const NAME = 'schema:tissueSample';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PathologyTest' => 'Jolicode\SchemaOrg\Type\PathologyTestModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
