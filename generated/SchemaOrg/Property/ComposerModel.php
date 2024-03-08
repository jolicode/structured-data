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

final class ComposerModel
{
    public const DESCRIPTION = 'The person or organization who wrote a composition, or who is the composer of a work performed at some event.';
    public const LABEL = 'composer';
    public const NAME = 'schema:composer';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Event' => 'SchemaOrg\Type\EventModel', 'MusicComposition' => 'SchemaOrg\Type\MusicCompositionModel'];
}
