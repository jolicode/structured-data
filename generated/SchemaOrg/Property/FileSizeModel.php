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

final class FileSizeModel
{
    public const DESCRIPTION = 'Size of the application / package (e.g. 18MB). In the absence of a unit (MB, KB etc.), KB will be assumed.';
    public const LABEL = 'fileSize';
    public const NAME = 'schema:fileSize';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['SoftwareApplication' => 'SchemaOrg\Type\SoftwareApplicationModel'];
}
