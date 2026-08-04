<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Type;

use Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class BookFormatTypeModel
{
    public const DESCRIPTION = 'The publication format of the book.';
    public const LABEL = 'BookFormatType';
    public const NAME = 'schema:BookFormatType';
    public const PARENTS = ['EnumerationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['AudiobookFormatModel' => 'EnumerationMember\AudiobookFormatModel', 'EBookModel' => 'EnumerationMember\EBookModel', 'GraphicNovelModel' => 'EnumerationMember\GraphicNovelModel', 'HardcoverModel' => 'EnumerationMember\HardcoverModel', 'PamphletModel' => 'EnumerationMember\PamphletModel', 'PaperbackModel' => 'EnumerationMember\PaperbackModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
