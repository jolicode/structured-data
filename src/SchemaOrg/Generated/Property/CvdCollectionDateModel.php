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

final class CvdCollectionDateModel
{
    public const DESCRIPTION = 'collectiondate - Date for which patient counts are reported.';
    public const LABEL = 'cvdCollectionDate';
    public const NAME = 'schema:cvdCollectionDate';
    public const VALUES = ['DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CDCPMDRecord' => 'Jolicode\SchemaOrg\Type\CDCPMDRecordModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
