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

final class WorkFeaturedModel
{
    public const DESCRIPTION = 'A work featured in some event, e.g. exhibited in an ExhibitionEvent.
       Specific subproperties are available for workPerformed (e.g. a play), or a workPresented (a Movie at a ScreeningEvent).';
    public const LABEL = 'workFeatured';
    public const NAME = 'schema:workFeatured';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\Type\CreativeWorkModel'];
    public const TYPES = ['Event' => 'SchemaOrg\Type\EventModel'];
}
