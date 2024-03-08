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

final class AuthorModel
{
    public const DESCRIPTION = 'The author of this content or rating. Please note that author is special in that HTML 5 provides a special mechanism for indicating authorship via the rel tag. That is equivalent to this and may be used interchangeably.';
    public const LABEL = 'author';
    public const NAME = 'schema:author';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'Rating' => 'SchemaOrg\Type\RatingModel'];
}
