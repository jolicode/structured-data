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

final class PositiveNotesModel
{
    public const DESCRIPTION = 'Provides positive considerations regarding something, for example product highlights or (alongside [[negativeNotes]]) pro/con lists for reviews.

In the case of a [[Review]], the property describes the [[itemReviewed]] from the perspective of the review; in the case of a [[Product]], the product itself is being described.

The property values can be expressed either as unstructured text (repeated as necessary), or if ordered, as a list (in which case the most positive is at the beginning of the list).';
    public const LABEL = 'positiveNotes';
    public const NAME = 'schema:positiveNotes';
    public const VALUES = ['ItemListModel' => 'Jolicode\SchemaOrg\Type\ItemListModel', 'ListItemModel' => 'Jolicode\SchemaOrg\Type\ListItemModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'WebContentModel' => 'Jolicode\SchemaOrg\Type\WebContentModel'];
    public const TYPES = ['Product' => 'Jolicode\SchemaOrg\Type\ProductModel', 'Review' => 'Jolicode\SchemaOrg\Type\ReviewModel'];
}
