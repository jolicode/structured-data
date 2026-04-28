<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class CountryOfOriginModel
{
    public const DESCRIPTION = 'The country of origin of something, including products as well as creative  works such as movie and TV content.

In the case of TV and movie, this would be the country of the principle offices of the production company or individual responsible for the movie. For other kinds of [[CreativeWork]] it is difficult to provide fully general guidance, and properties such as [[contentLocation]] and [[locationCreated]] may be more applicable.

In the case of products, the country of origin of the product. The exact interpretation of this may vary by context and product type, and cannot be fully enumerated here.';
    public const LABEL = 'countryOfOrigin';
    public const NAME = 'schema:countryOfOrigin';
    public const VALUES = ['CountryModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CountryModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'Movie' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MovieModel', 'Product' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ProductModel', 'TVEpisode' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TVEpisodeModel', 'TVSeason' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TVSeasonModel', 'TVSeries' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TVSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
