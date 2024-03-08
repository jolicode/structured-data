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

final class DatasetTimeIntervalModel
{
    public const DESCRIPTION = 'The range of temporal applicability of a dataset, e.g. for a 2011 census dataset, the year 2011 (in ISO 8601 time interval format).';
    public const LABEL = 'datasetTimeInterval';
    public const NAME = 'schema:datasetTimeInterval';
    public const VALUES = ['DateTimeModel' => 'SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Dataset' => 'SchemaOrg\Type\DatasetModel'];
}
