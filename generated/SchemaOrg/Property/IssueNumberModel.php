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

final class IssueNumberModel
{
    public const DESCRIPTION = 'Identifies the issue of publication; for example, "iii" or "2".';
    public const LABEL = 'issueNumber';
    public const NAME = 'schema:issueNumber';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\Type\IntegerModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['PublicationIssue' => 'SchemaOrg\Type\PublicationIssueModel'];
}
