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

final class CvdCollectionDateModel
{
    public const DESCRIPTION = 'collectiondate - Date for which patient counts are reported.';
    public const LABEL = 'cvdCollectionDate';
    public const NAME = 'schema:cvdCollectionDate';
    public const VALUES = ['DateTimeModel' => 'SchemaOrg\Type\DateTimeModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['CDCPMDRecord' => 'SchemaOrg\Type\CDCPMDRecordModel'];
}
