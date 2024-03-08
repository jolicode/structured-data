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

final class ArchivedAtModel
{
    public const DESCRIPTION = 'Indicates a page or other link involved in archival of a [[CreativeWork]]. In the case of [[MediaReview]], the items in a [[MediaReviewItem]] may often become inaccessible, but be archived by archival, journalistic, activist, or law enforcement organizations. In such cases, the referenced page may not directly publish the content.';
    public const LABEL = 'archivedAt';
    public const NAME = 'schema:archivedAt';
    public const VALUES = ['URLModel' => 'SchemaOrg\Type\URLModel', 'WebPageModel' => 'SchemaOrg\Type\WebPageModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel'];
}
