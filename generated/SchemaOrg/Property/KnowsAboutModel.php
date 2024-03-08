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

final class KnowsAboutModel
{
    public const DESCRIPTION = 'Of a [[Person]], and less typically of an [[Organization]], to indicate a topic that is known about - suggesting possible expertise but not implying it. We do not distinguish skill levels here, or relate this to educational content, events, objectives or [[JobPosting]] descriptions.';
    public const LABEL = 'knowsAbout';
    public const NAME = 'schema:knowsAbout';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel', 'ThingModel' => 'SchemaOrg\Type\ThingModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['Organization' => 'SchemaOrg\Type\OrganizationModel', 'Person' => 'SchemaOrg\Type\PersonModel'];
}
