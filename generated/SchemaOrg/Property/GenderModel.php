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

final class GenderModel
{
    public const DESCRIPTION = 'Gender of something, typically a [[Person]], but possibly also fictional characters, animals, etc. While https://schema.org/Male and https://schema.org/Female may be used, text strings are also acceptable for people who do not identify as a binary gender. The [[gender]] property can also be used in an extended sense to cover e.g. the gender of sports teams. As with the gender of individuals, we do not try to enumerate all possibilities. A mixed-gender [[SportsTeam]] can be indicated with a text value of "Mixed".';
    public const LABEL = 'gender';
    public const NAME = 'schema:gender';
    public const VALUES = ['GenderTypeModel' => 'SchemaOrg\Type\GenderTypeModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Person' => 'SchemaOrg\Type\PersonModel', 'SportsTeam' => 'SchemaOrg\Type\SportsTeamModel'];
}
