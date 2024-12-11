<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ComposerModel
{
    public const DESCRIPTION = 'The person or organization who wrote a composition, or who is the composer of a work performed at some event.';
    public const LABEL = 'composer';
    public const NAME = 'schema:composer';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Event' => 'Jolicode\SchemaOrg\Type\EventModel', 'MusicComposition' => 'Jolicode\SchemaOrg\Type\MusicCompositionModel'];
}
