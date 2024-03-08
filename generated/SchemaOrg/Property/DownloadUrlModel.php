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

final class DownloadUrlModel
{
    public const DESCRIPTION = 'If the file can be downloaded, URL to download the binary.';
    public const LABEL = 'downloadUrl';
    public const NAME = 'schema:downloadUrl';
    public const VALUES = ['URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['SoftwareApplication' => 'SchemaOrg\Type\SoftwareApplicationModel'];
}
