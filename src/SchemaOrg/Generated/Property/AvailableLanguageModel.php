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

final class AvailableLanguageModel
{
    public const DESCRIPTION = 'A language someone may use with or at the item, service or place. Please use one of the language codes from the [IETF BCP 47 standard](http://tools.ietf.org/html/bcp47). See also [[inLanguage]].';
    public const LABEL = 'availableLanguage';
    public const NAME = 'schema:availableLanguage';
    public const VALUES = ['LanguageModel' => 'Jolicode\SchemaOrg\Type\LanguageModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ContactPoint' => 'Jolicode\SchemaOrg\Type\ContactPointModel', 'Course' => 'Jolicode\SchemaOrg\Type\CourseModel', 'LodgingBusiness' => 'Jolicode\SchemaOrg\Type\LodgingBusinessModel', 'ServiceChannel' => 'Jolicode\SchemaOrg\Type\ServiceChannelModel', 'TouristAttraction' => 'Jolicode\SchemaOrg\Type\TouristAttractionModel'];
}
